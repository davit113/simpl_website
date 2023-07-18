(function(){
    const form           = document.querySelector('#product_form');
    const formInputSku   = document.querySelector('#sku');
    const formInputName  = document.querySelector('#name');
    const formInputPrice = document.querySelector('#price');
    const formInputHeight = document.querySelector('#height');
    const formInputWidth  = document.querySelector('#width');
    const formInputLength = document.querySelector('#length');
    const formInputWeight = document.querySelector('#weight');

    //on load
    document.addEventListener("DOMContentLoaded", ()=>{
        form.reset();
    });

    document.querySelector('#product_form > .input > #productType').addEventListener('change', (e) =>{
        const currentTarget = e.target;
        const products = document.querySelectorAll(".product");
        
        products.forEach((val)=>{ /* hide all input */
            val.classList.add('hidden');
            val.querySelectorAll('input')?.forEach((val)=>{
                val.required = false;
                val.value = "";
            })
        })
        const node =document.querySelector(`.product--${currentTarget.value}`);
        node?.classList.toggle('hidden');
        node?.querySelectorAll('input')?.forEach((val)=>{
            val.required = true;
        })
    })


    form.addEventListener('input', (e)=>{
        const numberOnlyInput = function(e){
            console.log(e.bubbles);
            const val = e.target.value;
            const expr = /^\d*\.?\d*$/;
            if(!expr.test(val)){
                e.target.value =val.slice(0,val.length-1);
            }
        }
        const arr =[
            formInputPrice,
            formInputHeight,
            formInputWidth,
            formInputLength,
            formInputWeight,
        ];
        if(arr.includes(e.target))numberOnlyInput(e);
    })

})();





