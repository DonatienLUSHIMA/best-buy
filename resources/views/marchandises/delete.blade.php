<form action="{{ route('marchandises.destroy', $marchandise->id) }}" method="post">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet élève ?')">Supprimer</button>
</form>