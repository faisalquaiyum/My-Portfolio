let input = document.getElementById('inputBox')
let buttons = document.querySelectorAll('button')

buttons.forEach(element => {
    element.addEventListener('click', (e) => {
        console.log(e.target.textContent)

        if(e.target.textContent === "AC"){
            input.value = ""
        }
        else if(e.target.textContent === "DEL"){
            input.value = input.value.slice(0, -1)
        }
        else if(e.target.textContent === "="){
            input.value = eval(input.value)
        }
        // else if(e.target.textContent === "sin"){
        //     // var x = input.value;
        //     // x = x * Math.PI/180;
        //     input.value = (Math.sin(input.value*(Math.PI/180)))
        // }
        else{
            input.value += e.target.textContent
        }
        input.scrollLeft = input.scrollWidth
    })
})
