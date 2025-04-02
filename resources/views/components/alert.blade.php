@props(['type' , 'text'])
<style>
    .alert{
        width: 1090px;
        margin-left: -250px;
    }
</style>
<div>
    <div
        class="alert alert-{{$type}}"
        role="alert"
    >
    <strong>{{$slot}}</strong>
    </div>
    
</div>