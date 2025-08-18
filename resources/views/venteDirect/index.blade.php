@extends('layouts.app')

@section('content')
<div x-data="venteDirecte()" class="p-6 bg-blue-50 rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-4">Vente directe</h1>

    <!-- Bouton valider -->
    <button @click="validerVente()" class="mb-4 bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
        📦 Validez la vente
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
            <template x-for="(ligne, index) in lignes" :key="index">
                <tr class="border-t">
                    <td class="p-2">
                        <input type="text" x-model="ligne.produit" placeholder="Nom du produit" class="border rounded p-1 w-full">
                    </td>
                    <td class="p-2">
                        <input type="number" x-model="ligne.quantite" @input="calculer(index)" min="1" class="border rounded p-1 w-20">
                    </td>
                    <td class="p-2">
                        <input type="number" x-model="ligne.prix" @input="calculer(index)" min="0" class="border rounded p-1 w-24">
                    </td>
                    <td class="p-2">
                        <input type="number" x-model="ligne.remise" @input="calculer(index)" min="0" class="border rounded p-1 w-20">
                    </td>
                    <td class="p-2">
                        <input type="text" x-model="ligne.net" readonly class="border rounded p-1 w-24 bg-gray-100">
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
        <label>Subentites :</label>
        <select class="border rounded p-2 w-1/3">
            <option value="">Sélectionnez un subentite</option>
            @foreach($subentites as $subentite)
                <option value="{{ $subentite->id }}">{{ $subentite->nom }}</option>
            @endforeach
        </select>

        <div>Total quantité : <span x-text="totalQuantite"></span></div>
        <div>Total : <span x-text="total"></span> GNF</div>
        <div>Remise globale : <input type="number" x-model="remiseGlobale" @input="calculerTotal()" class="border rounded p-1 w-20"></div>
        <div class="font-bold text-lg">Net à payer : <span x-text="netAPayer"></span> GNF</div>

        <div>
            Situation :
            <label><input type="radio" name="situation" value="soldé"> Soldé</label>
            <label class="ml-4"><input type="radio" name="situation" value="crédit"> Crédit</label>
        </div>
    </div>

    <!-- Ajouter une ligne -->
    <button @click="ajouter()" class="mt-4 bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">+ Ajouter une ligne</button>
</div>

<script>
function venteDirecte() {
    return {
        lignes: [
            { produit: '', quantite: 1, prix: 0, remise: 0, net: 0 }
        ],
        totalQuantite: 0,
        total: 0,
        remiseGlobale: 0,
        netAPayer: 0,

        calculer(index) {
            let l = this.lignes[index];
            l.net = (l.quantite * l.prix) - l.remise;
            this.calculerTotal();
        },
        calculerTotal() {
            this.totalQuantite = this.lignes.reduce((s, l) => s + Number(l.quantite), 0);
            this.total = this.lignes.reduce((s, l) => s + Number(l.net), 0);
            this.netAPayer = this.total - this.remiseGlobale;
        },
        ajouter() {
            this.lignes.push({ produit: '', quantite: 1, prix: 0, remise: 0, net: 0 });
        },
        supprimer(index) {
            this.lignes.splice(index, 1);
            this.calculerTotal();
        },
        validerVente() {
            alert("Vente validée !");
            // ici tu feras un post vers ton contrôleur Laravel
        }
    }
}
</script>
@endsection
