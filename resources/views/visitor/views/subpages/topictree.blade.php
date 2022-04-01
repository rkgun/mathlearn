@foreach($parentTopics as $topic)
<h2 class="topic-title"><a class="subtopic-title" href="/topic/{{$topic->slug}}">{{$topic->title}}</a></h2>
  @if(count($topic->childs))
    @include('visitor.views.subpages.subtopic',['subtopics' => $topic->childs])
  @endif
 
@endforeach