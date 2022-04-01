@foreach($subtopics as $subtopic)
<ul class="course-content-list">
    <li></li> 
    <li class="course-content-item"><a class="subtopic-title" href="/topic/{{$subtopic->slug}}">{{$subtopic->title}}</a></li>
  @if(count($subtopic->childs))
    @include('visitor.views.subpages.subtopic',['subtopics' => $subtopic->childs])
  @endif
 </ul> 
@endforeach