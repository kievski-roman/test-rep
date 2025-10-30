<h1>Марки</h1>
<a href="{{ route('car-brands.create') }}">Додати</a>
<table>
    @foreach($brands as $brand)
        <tr>
            <td>{{ $brand->name }}</td>
            <td>
                <a href="{{ route('car-brands.edit', $brand) }}">Редагувати</a>
                <form action="{{ route('car-brands.destroy', $brand) }}" method="POST" style="display:inline">
                    @csrf @method('DELETE')
                    <button>Видалити</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
{{ $brands->links() }}
