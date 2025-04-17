<div class="mb-3">
    <label for="name" class="form-label">Tên</label>
    <input type="text" name="name" id="name" class="form-control"
           value="{{ old('name', $user->name ?? '') }}">
    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" name="email" id="email" class="form-control"
           value="{{ old('email', $user->email ?? '') }}">
    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="mb-3">
    <label for="password" class="form-label">Mật khẩu</label>
    <input type="password" name="password" id="password" class="form-control">
    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="mb-3">
    <label for="password_confirmation" class="form-label">Xác nhận mật khẩu</label>
    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
</div>

<div class="mb-3">
    <label for="role" class="form-label">Vai trò</label>
    <select name="role" id="role" class="form-control">
        <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
        <option value="user" {{ old('role', $user->role ?? '') == 'user' ? 'selected' : '' }}>User</option>
    </select>
    @error('role') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<button type="submit" class="btn btn-success">Lưu</button>
<a href="{{ route('users.index') }}" class="btn btn-secondary">Huỷ</a>
