@can('update', $project)
    <a href="{{ route('projects.edit', $project) }}" class="text-blue-600 hover:underline">
        Editar
    </a>
@endcan
 
@can('delete', $project)
    <form action="{{ route('projects.destroy', $project) }}" method="POST" onsubmit="return confirm('¿Eliminar proyecto?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
    </form>
@endcan
