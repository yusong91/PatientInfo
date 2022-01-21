<!doctype html>
<html lang="en">
  <head>

    <?php  

        ini_set('memory_limit', '1024M');
        ini_set("pcre.backtrack_limit", "2000000000");
    ?> 

  <style type="text/css">
               
      body { font-family: 'khmerfont';   font-size: 11px !important;}


      #customers {
        font-family: "khmerfont", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        table-layout: fixed;
        width: 100%;
        font-size: 11px;

      }

      #customers td, #customers th {
        
        border: 1px solid #ddd;
        padding: 5px;
      } 

      #customers tr:nth-child(even){background-color: #f2f2f2;}

      #customers tr:hover {

        background-color: #ddd;
        page-break-inside: avoid;
      }

      #customers th {

        padding-top: 10px;
        padding-bottom: 10px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
      }

      h5{
        display: inline-block;
        vertical-align: middle;
        line-height: 1px;
      }

#customers {
  border: 1px solid black;
  table-layout: fixed;
  
}
  </style>     
</head>
            <body>

                  <div class="card">

                      <div class="card-body">

                        <h4 style="text-align: center; font-size: 14px;"></h4>
                       
                            
                           <div>
                   
                              <table id="customers">
                                    <thead style="font-size: 12px; font-weight: bold;"> 
                                     
                                      <tr >
                                        <th style="text-align: center;">#</th>
                                        <th style="text-align:center;">Time</th>
                                        <th style="text-align:center;">Date</th>
                                        <th style="text-align: center;">LatLong</th>
                                        <th style="text-align: center;">Address BTS</th>
                                        
                                      </tr>
                                    
                                    </thead>
                                    <tbody>
                                   
                                        <tr>  
                                            <td style ="text-align: center;">សុង</td>
                                        </tr>

                                    </tbody>
                              </table>
                        </div>


                    </div>
                </div>

  </body>
</html>

