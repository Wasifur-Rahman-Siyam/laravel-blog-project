<script>
    var msg = '{{Session::get('msg')}}';
    var exist = '{{Session::has('msg')}}';
    if(exist){
    alert(msg);
    }
</script>