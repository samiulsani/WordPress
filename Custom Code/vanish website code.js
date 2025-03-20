//https://www.youtube.com/watch?v=tLWO1Pz64RE
//On any page of elementor take html widget and paste this code.
//After date website will vanish and after delete this code website will be normal




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
(function($){
    
//Vanishing Date YY-MM-DD
    var vanishing_date = new Date('2025-03-25'),
    
        current_date = new Date(),
        utc1 = Date.UTC(vanishing_date.getFullYear(), vanishing_date.getMonth(), vanishing_date.getDate()),
        utc2 = Date.UTC(current_date.getFullYear(), current_date.getMonth(), current_date.getDate()),
        days = Math.floor((utc1 - utc2) / (1000 * 60 * 60 * 24))
    
    if(days <= 0) {
    
        $('body > *').fadeOut(5000)
        setTimeout( function(){
            $('body').append( $('.client-message') )
            $('.client-message').fadeIn()
        }, 5000 )
    }
}(jQuery))
</script>
<style>
    .client-message{
        background: red;
        color: #fff;
        font-family: Poppins;
        font-weight: Bold;
        font-size: 8vw;
        display: none;
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        padding: 5%;
    }
    .client-message p{
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        line-height: 1.3;
    }
</style>
<div class="client-message">
    <p>Please... <br/>Pay Your Developer! <br/> or contact sameulslm@gmail.com</p>
</div>
