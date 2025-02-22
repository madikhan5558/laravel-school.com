<div class="chat-header clearfix">
    @include('chat._header')
</div>

<div class="chat-history">
    @include('chat._chat')

</div>

<div class="chat-message clearfix">
    <form action="" id="" method="post" class="mb-0">
        <input type="text">
        @csrf
        <textarea class="form-control" name="" id="" cols="" rows=""></textarea>
        <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6 text-right mt-2">
                <button class="btn btn-primary">Send</button>
            </div>
        </div>
    </form>
</div>
