<style>
  #lista3 {
    list-style: none; 
    *list-style: decimal; 
    font: 15px;
    padding: 0;
    margin-bottom: 0em;
    text-shadow: 0 1px 0 rgba(255,255,255,.5);
  }

  #lista3 ol {
      margin: 0 0 0 0em; 
  }

  #lista3 li{
      position: relative;
      display: block;
      padding: .2em .2em .2em .4em;
      *padding: .2em;
      margin: .2em 0 .2em 2.5em;
      background: #ddd;
      color: #444;
      text-decoration: none;
      transition: all .3s ease-out;   
  }

  #lista3 li:hover{
      background: #eee;
  }   

  #lista3 li:before{
       content: attr(seq);
      position: absolute; 
      left: -2.5em;
      top: 10%;
      margin-top: -1em;
      background: #fa8072;
      height: 2em;
      width: 3em;
      line-height: 2em;
      text-align: center;
      font-weight: bold;
  }

  #lista3 li:after{
      position: absolute; 
      content: '';
      border: .5em solid transparent;
      left: -1em;
      top: 10%;
      margin-top: -.5em;
      transition: all .3s ease-out;               
  }

  #lista3 li:hover:after{
      left: -.5em;
      border-left-color: #fa8072;             
  }
</style>
<div class="row">
  <div class="col-11">
    <ol id="lista3">
      <li seq="7">Eje
        <ol>
          <li seq="7.1">Actividad global
            <ol>
              <li seq="7.1.2">Actividad general
                <ol>
                  <li seq="7.1.2.3">Actividad particular</li>
                </ol>
              </li>
            </ol>
          </li>
        </ol>
      </li>
    </ol>
  </div>
  <div class="col-1">
    <button id="cerrarInv" type="button" class="close text-white" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  </div>
</div>