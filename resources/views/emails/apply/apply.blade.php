<h3>새로운 등록신청 메일입니다.</h3>
<div>
	
	<strong>이름 : {{ $name }} </strong>
</div>

<p><strong>지원이유: </strong>{{ $context }}</p>
<strong><작품리스트></strong> <br/>
<ul>
@forelse($items as $item)
	<li>{{$item}}</li>
@empty
<p>작품이 없습니다.</p>
@endforelse
</ul>