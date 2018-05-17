<label for="">Имя</label>
<input type="text" class="form-control" name="name" placeholder="Имя пользователя" value="@if(old('name')){{ old('name') }}@else{{ $user->name or "" }} @endif" required>

<label for="">email</label>
<input type="text" class="form-control" name="email" placeholder="Email" value="@if(old('email')){{ old('email') }}@else{{ $user->email or "" }} @endif"  required>

{{-- :TODO втулить превью <img src="{{ asset('upload/'.$image->img) }}">--}}
<label for="">Изображение</label>
<input type="file" name="avatar">

<label for="">Пароль</label>
<input type="password" class="form-control" name="password" required>

<label for="">Подтверждение пароля</label>
<input type="password" class="form-control" name="password_confirmation" required>

<hr />

<input class="btn btn-primary" type="submit" value="Сохранить">