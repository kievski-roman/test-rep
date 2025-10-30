
    <div class="container">
        <h1>Добавить автобус</h1>

        <form action="{{ route('buses.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Гос. номер</label>
                <input type="text" name="number_bus" class="form-control" value="{{ old('number_bus') }}" required>
                @error('number_bus')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Марка</label>
                <select name="car_brand_id" class="form-select" required>
                    <option value="">Выберите марку</option>
                    @foreach($carBrands as $brand)
                        <option value="{{ $brand->id }}" {{ old('car_brand_id') == $brand->id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>
                @error('car_brand_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Водитель</label>
                <select name="driver_id" class="form-select">
                    <option value="">Без водителя</option>
                    @foreach($drivers as $driver)
                        <option value="{{ $driver->id }}" {{ old('driver_id') == $driver->id ? 'selected' : '' }}>
                            {{ $driver->first_name }} {{ $driver->last_name }}
                        </option>
                    @endforeach
                </select>
                @error('driver_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Сохранить</button>
            <a href="{{ route('buses.index') }}" class="btn btn-secondary">Отмена</a>
        </form>
    </div>
