<ul>
    @foreach($childs as $child)
        <li>
            <div style="min-width: 120px;">
                <input name="cats[]" style="margin-left: 5px;" id="{{$child->id}}" type="checkbox" value="{{$child->id}}">
                <label for="{{$child->id}}"> {{{ $child->name }}}</label>
            </div>
            @if(count($child->childs))
                @include('admin.components.createCat',['childs' => $child->childs])
            @endif
        </li>
    @endforeach
</ul>
