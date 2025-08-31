@extends('layouts.app')

@section('content')
<!-- Inclure Alpine.js si ce n'est pas déjà fait dans layouts.app -->
<script src="//unpkg.com/alpinejs" defer></script>

<div x-data="venteDirecte()" class="p-6 bg-blue-10 rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-4">Vente directe</h1>

    <!-- Sélection entité -->
    <label class="block mb-2 font-semibold">Entité / Sous-entité :</label>
    <select x-model="subEntiteId" name="sub_entite_id" class="border rounded p-2 w-1/3 mb-4">
        <option value="">-- Sélectionnez une entité --</option>
        @foreach($subEntites as $subentite)
            <option value="{{ $subentite->id }}">{{ $subentite->nom }}</option>
        @endforeach
    </select>

    <!-- Bouton valider -->
    <button @click="validerVente()" class="mb-4 bg-gray-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
        📦 Valider la vente
    </button>

    <!-- Tableau -->
    <table class="w-full border bg-white rounded shadow">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2">Produit</th>
                <th class="p-2">Quantité</th>
                <th class="p-2">Prix</th>
                <th class="p-2">Remise</th>
                <th class="p-2">Net</th>
                <th class="p-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <template x-for="(detail, index) in details" :key="index">
                <tr class="border-t">
                    <td class="p-2">
                        <select x-model="detail.produit_id" @change="majPrix(index)" class="border rounded p-1 w-full">
                            <option value="">-- Produit --</option>
                            @foreach($categories as $categorie)
                                <optgroup label="{{ $categorie->nom }}">
                                    @foreach($categorie->produits as $produit)
                                        <option value="{{ $produit->id }}" data-prix="{{ $produit->prix }}">
                                            {{ $produit->nom }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </td>
                    <td class="p-2">
                        <input type="number" x-model="detail.quantite" @input="calculer(index)" min="1" class="border rounded p-1 w-20">
                    </td>
                    <td class="p-2">
                        <input type="number" x-model="detail.prix" @input="calculer(index)" min="0" class="border rounded p-1 w-24">
                    </td>
                    <td class="p-2">
                        <input type="number" x-model="detail.remise" @input="calculer(index)" min="0" class="border rounded p-1 w-20">
                    </td>
                    <td class="p-2">
                        <input type="text" x-model="detail.net" readonly class="border rounded p-1 w-24 bg-gray-100">
                    </td>
                    <td class="p-2 text-center">
                        <button @click="supprimer(index)" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">🗑</button>
                    </td>
                </tr>
            </template>
        </tbody>
    </table>

    <!-- Résumé -->
    <div class="mt-4 space-y-2">
        <div>Total quantité : <span x-text="totalQuantite"></span></div>
        <div>Total : <span x-text="total"></span> GNF</div>
        <div>
            Remise globale : 
            <input type="number" x-model="remiseGlobale" @input="calculerTotal()" class="border rounded p-1 w-20">
        </div>
        <div class="font-bold text-lg">Net à payer : <span x-text="netAPayer"></span> GNF</div>

        <div>
            Situation :
            <label><input type="radio" name="situation" value="soldé" x-model="situation"> Soldé</label>
            <label class="ml-4"><input type="radio" name="situation" value="crédit" x-model="situation"> Crédit</label>
        </div>
    </div>

    <!-- Ajouter une ligne -->
    <button @click="ajouter()" class="mt-4 bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">+ Ajouter une ligne</button>
</div>

<script>
function venteDirecte() {
    return {
        subEntiteId: "",
        details: [
            { produit_id: '', quantite: 1, prix: 0, remise: 0, net: 0 }
        ],
        totalQuantite: 0,
        total: 0,
        remiseGlobale: 0,
        netAPayer: 0,
        situation: "soldé",

        majPrix(index) {
            let select = document.querySelectorAll("select[x-model='detail.produit_id']")[index];
            let prix = select.options[select.selectedIndex]?.dataset.prix;
            this.details[index].prix = prix ? Number(prix) : 0;
            this.calculer(index);
        },
        calculer(index) {
            let l = this.details[index];
            l.net = (l.quantite * l.prix) - l.remise;
            this.calculerTotal();
        },
        calculerTotal() {
            this.totalQuantite = this.details.reduce((s, l) => s + Number(l.quantite), 0);
            this.total = this.details.reduce((s, l) =>s + ((l.quantite * l.prix) ), 0);
            this.remiseGlobale = this.details.reduce((s, l) => s + Number(l.remise), 0);
            this.netAPayer = this.total - this.remiseGlobale;
        },
        ajouter() {
            this.details.push({ produit_id: '', quantite: 1, prix: 0, remise: 0, net: 0 });
        },
        supprimer(index) {
            this.details.splice(index, 1);
            this.calculerTotal();
        },
       validerVente() {
    if (!this.subEntiteId) {
        alert("⚠️ Veuillez choisir une entité !");
        return;
    }
    for (let detail of this.details) {
        if (!detail.produit_id) {
            alert("⚠️ Veuillez sélectionner un produit pour toutes les lignes !");
            return;
        }
    }

    fetch("{{ route('ventes.store') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Accept":"application/json"
        },
        body: JSON.stringify({
            sub_entite_id: this.subEntiteId,
            quantite: this.totalQuantite, // AJOUT
            remise_globale: this.remiseGlobale,
            net: this.netAPayer,
            etat_commande: "en_attente", // exemple
            status: this.situation, // ou soldé / crédit
            details: this.details
        })
    })
    .then(res => {
        if (!res.ok) throw new Error("Erreur serveur");
        return res.json();
    })
    .then(data => {
        alert("✅ Vente enregistrée avec succès !");
        window.location.reload(); // ou redirection si tu veux
    })
    .catch(err => {
        console.error(err);
        alert("❌ Erreur lors de l'enregistrement de la vente");
    });
}
    }
}
</script>
@endsection
