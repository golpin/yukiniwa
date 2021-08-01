<div class="flex flex-col sm:flex-row">
    <span class="mx-2 my-auto">
        表示順
    </span>
    <select name="sort" id="sort" class="text-sm ">
        <option value="1" @if(\Request::get('sort')=="1" ) selected @endif>
            新しい順
        </option>
        <option value="2" @if(\Request::get('sort')=="2" ) selected @endif>
            古い順
        </option>
    </select>
</div>