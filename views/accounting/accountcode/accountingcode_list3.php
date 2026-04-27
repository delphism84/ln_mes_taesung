<!DOCTYPE html>
<html>
  <head>
    <title>Bootstrap Tree View</title>
    <link href="http://jonmiles.github.io/bootstrap-treeview/bower_components/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <script src="http://jonmiles.github.io/bootstrap-treeview/bower_components/jquery/dist/jquery.js"></script>
  	<script src="http://jonmiles.github.io/bootstrap-treeview/js/bootstrap-treeview.js"></script>
  </head>
  <body>
  	<div class="container">
    	<h1>Tree View</h1>
      <br>
      <div class="row">
        <div class="col-sm-4">
          <h2>Expanded</h2>
          <div id="treeview3" class=""></div>
        </div>
      </div>
      </div>
      <br/>
      <br/>
      <br/>
      <br/>
    </div>
  	<script type="text/javascript">

  		$(function() {

        var defaultData = [
          {
            text: 'Parent 1',
            href: '#parent1',
            tags: ['4'],
            nodes: [
              {
                text: 'Child 1',
                href: '#child1',
                tags: ['2'],
                nodes: [
                  {
                    text: 'Grandchild 1',
                    href: '#grandchild1',
                    tags: ['0']
                  },
                  {
                    text: 'Grandchild 2',
                    href: '#grandchild2',
                    tags: ['0']
                  }
                ]
              },
              {
                text: 'Child 2',
                href: '#child2',
                tags: ['0']
              }
            ]
          },
          {
            text: 'Parent 2',
            href: '#parent2',
            tags: ['0']
          },
          {
            text: 'Parent 3',
            href: '#parent3',
             tags: ['0']
          },
          {
            text: 'Parent 4',
            href: '#parent4',
            tags: ['0']
          },
          {
            text: 'Parent 5',
            href: '#parent5'  ,
            tags: ['0']
          }
        ];
        
        $('#treeview3').treeview({
          levels: 99,
          data: defaultData
        });
  		});
  	</script>
  </body>
</html>
