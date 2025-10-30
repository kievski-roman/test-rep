
    <div class="container">
        <h1>Автобусы</h1>

        <a href="{{ route('buses.create') }}" class="btn btn-primary mb-3">Добавить автобус</a>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
            <tr>
                <th>Гос. номер</th>
                <th>Марка</th>
                <th>Водитель</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($buses as $bus)
                <tr>
                    <td>{{ $bus->number_bus }}</td>
                    <td>{{ $bus->carBrand->name }}</td>
                    <td>
                        @if($bus->driver)
                            {{ $bus->driver->first_name }} {{ $bus->driver->last_name }}
                        @else
                            <span class="text-muted">Не назначен</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('buses.edit', $bus) }}" class="btn btn-sm btn-warning">Редактировать</a>
                        <form action="{{ route('buses.destroy', $bus) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Удалить?')">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $buses->links() }}
    </div>
