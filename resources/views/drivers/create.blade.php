
    <h1>Додати водія</h1>

    <form action="{{ route('drivers.store') }}" method="POST">
        @csrf

        <div>
            <label>Ім'я</label>
            <input type="text" name="first_name" value="{{ old('first_name') }}" required>
        </div>

        <div>
            <label>Прізвище</label>
            <input type="text" name="last_name" value="{{ old('last_name') }}" required>
        </div>

        <div>
            <label>Дата народження</label>
            <input type="date" name="birth_date" value="{{ old('birth_date') }}" required>
        </div>

        <div id="photos"></div>
        <button type="button" onclick="addPhoto()">+ Додати фото</button>

        <button type="submit">Зберегти</button>
    </form>

    <script>
        let i = 0;
        function addPhoto() {
            const div = document.createElement('div');
            div.innerHTML = `
        <input type="text" name="photo[${i}][text]" placeholder="Текст">
        <input type="url" name="photo[${i}][src]" placeholder="URL фото">
    `;
            document.getElementById('photos').appendChild(div);
            i++;
        }
    </script>
