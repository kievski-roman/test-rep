<h1>Водії</h1>
<a href="{{ route('drivers.create') }}">Додати</a>
<table>
    @foreach($drivers as $driver)
        <tr>
            <td>{{ $driver->first_name }} {{ $driver->last_name }}</td>
            <td>{{ $driver->birth_date->age }} років</td>
            <td>
                @if($driver->photo)
                    @foreach($driver->photo as $p)
                        <div>{{ $p['text'] }}: <a href="{{ $p['src'] }}" target="_blank">фото</a></div>
                    @endforeach
                @endif
            </td>
            <td>
                <a href="{{ route('drivers.edit', $driver) }}">Редагувати</a>
                <form action="{{ route('drivers.destroy', $driver) }}" method="POST" style="display:inline">
                    @csrf @method('DELETE')
                    <button>Видалити</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
{{ $drivers->links() }}
