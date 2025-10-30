
    <h1>Редагувати водія</h1>

    <form action="{{ route('drivers.update', $driver) }}" method="POST">
        @csrf @method('PUT')

        <div>
            <label>Ім'я</label>
            <input type="text" name="first_name" value="{{ old('first_name', $driver->first_name) }}" required>
        </div>

        <div>
            <label>Прізвище</label>
            <input type="text" name="last_name" value="{{ old('last_name', $driver->last_name) }}" required>
        </div>

        <div>
            <label>Дата народження</label>
            <input type="date" name="birth_date" value="{{ old('birth_date', $driver->birth_date) }}" required>
        </div>

        <div id="photos">
            @foreach($driver->photo ?? [] as $index => $photo)
                <div>
                    <input type="text" name="photo[{{ $index }}][text]" value="{{ $photo['text'] ?? '' }}" placeholder="Текст">
                    <input type="url" name="photo[{{ $index }}][src]" value="{{ $photo['src'] ?? '' }}" placeholder="URL фото">
                </div>
            @endforeach
        </div>

        <button type="button" onclick="addPhoto()">+ Додати фото</button>
        <button type="submit">Оновити</button>
    </form>

