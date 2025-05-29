@extends('admin.layout')

@section('title','Chỉnh sửa danh mục')

@section('content')
<form action="{{route ('admin.category.update', $category->id)}}" method="POST">
@csrf
@method('PUT')
<div class="mb-3">
            <label for="name" class="form-label">Tên danh mục</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name',$category->name) }}">
            @error('name')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

    <div class="mb-3">
            <label for="status_categories" class="form-label">Trạng thái</label>
            <select name="status_categories" class="form-select" id="status">
                <option value="0" {{ old('status_categories',$category->status_categories) == '0' ? 'selected' : '' }}>Hoạt động</option>
                <option value="1" {{ old('status_categories',$category->status_categories) == '1' ? 'selected' : '' }}>Không hoạt động</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{route('categories.index')}}" class="btn btn-secondary" >Quay Lại</a>
</form>   
@endsection