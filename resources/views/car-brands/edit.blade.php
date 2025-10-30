<h1>Редагувати марку</h1>
<form action="{{ route('car-brands.update', $carBrand) }}" method="POST">
    @csrf @method('PUT')
    <input type="text" name="name" value="{{ $carBrand->name }}" required>
    <button>Оновити</button>
</form>
