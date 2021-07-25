
<div class="row">
    <div class="col-md-8 col-md-offset-4" style="margin: 0 auto;">
        <h2>投稿フォーム</h2>
        <form action="{{ route('store') }}" method="POST" onsubmit="return checkSubmit()" enctype="multipart/form-data">
            @csrf
            <div class="form-group">

                <label for="title">
                    タイトル
                </label>
                <input 
                type="text" 
                id="title" 
                name="title" 
                class="form-control" 
                value="{{ old('title')}}">

                @if($errors->first('title')) 
                <div class="text-danger">
                    {{ $errors->first('title') }}
                </div>
                @endif

            </div>

            <div class="form-group">
                <label for="content">
                    本文
                </label>
                <textarea 
                class="form-control" 
                name="content" 
                id="content" 
                rows="6"
                >{{ old('content') }}</textarea>

                @if ($errors->has('content'))
                <div class="text-danger">
                    {{ $errors->first('content') }}
                </div>
                @endif
            </div>
            <br>
            <div class="form-group">
                <input type="file" name="image" class="form-control">
            </div>
            <p>※画像は必須です。拡張子はjpg・jpeg・pngのいずれか限定です。</p>
            @if ($errors->has('image'))
                <div class="text-danger">
                    {{ $errors->first('image') }}
                </div>
            @endif
            

            <div class="mt-5">
                <a class="btn btn-secondary" href="{{ route('index') }}">
                    キャンセル
                </a>
                <button type="submit" class="btn btn-primary">
                    投稿する
                </button>
            </div>
            
        </form>
    </div>
</div>

<script>
    function checkSubmit(){
    if(window.confirm('送信してよろしいですか？')){
        return true;
    } else {
        return false;
    }
    }
    </script>

    
@endsection

