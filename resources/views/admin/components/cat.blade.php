<ul>
    @foreach($childs as $child)
        <li>
            <a class="{{request('parent_id') == $child->id ? 'text-danger' : '' }}" title="مشاهده زیر دسته ها" href="/admin/category?parent_id={{$child->id}}">{{{ $child->name }}}</a>
            @if(count($child->childs))
                @include('admin.components.cat',['childs' => $child->childs])
            @endif
        </li>
    @endforeach
</ul>
