<h1>Додати марку</h1>
<form action="{{ route('car-brands.store') }}" method="POST">
    @csrf
    <input type="text" name="name" required>
    <button>Зберегти</button>
</form>
