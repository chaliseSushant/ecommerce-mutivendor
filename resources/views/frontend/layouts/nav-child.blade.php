@foreach($childs->sortBy('order') as $child)
        <li>
            <a class="dropdown-item {{ count($child->childs) ? 'dropdown-toggle' :'' }}" href="{{url($child->url)}}">{{$child->name}}</a>
            @if(count($child->childs))
                <ul class="submenu dropdown-menu">
                    @include('frontend.layouts.nav-child',['childs' => $child->childs])
                </ul>
            @endif
        </li>
@endforeach


