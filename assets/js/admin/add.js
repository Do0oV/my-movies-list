
/**** **** **** **** **** **** **** ****
 > EVENTS
**** **** **** **** **** **** **** ****/

const eventValid = () => {

  const valid = document.querySelectorAll('#valid')

  valid.addEventListener('click', () => {

    POST({

        item:     'valid'
      // , action:   item.dataset.action
      // , value:    item.dataset.value

    }, DONE)

  })

}


/**** **** **** **** **** **** **** ****
 > POST
**** **** **** **** **** **** **** ****/

const POST = (data, cb) => {

  const XHR = new XMLHttpRequest()

  // XHR.open('POST', 'php/ajax/home.php')
  XHR.open('POST', '/')

  XHR.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')

  XHR.send(`request=${JSON.stringify(data)}`)

  XHR.onreadystatechange = () => {

    if(XHR.readyState === 4 && XHR.status === 200) {

      cb(JSON.parse(XHR.responseText))

    }

  }

}

/**** **** **** **** **** **** **** ****
 > CALLBACKS
**** **** **** **** **** **** **** ****/

const DONE = data => { console.log(data)


}

/**** **** **** **** **** **** **** ****
 > INIT
**** **** **** **** **** **** **** ****/

const INIT = function() {

  // eventValid()

}()
