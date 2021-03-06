<label for="blog_category_name">Category</label>
<select class="selectpicker form-control" multiple data-live-search="true" id="blog_category_name" rows="3" name="blogCategory[]" value="{{old('blogCategory')}}">
    @foreach ($blogCategories as $blogCategory)
        <option value="{{$blogCategory->id_blog_category}}">{{$blogCategory->name}}</option>
    @endforeach
</select>
