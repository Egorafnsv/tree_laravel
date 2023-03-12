<!DOCTYPE html>
{{-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> --}}
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Main</title>
        <style>
            div {  
                display: inline-block;
                float:left;
                margin-left: 10%;
            }

        </style>
    </head>
    <body>

        <div>
            <h4>плоский список</h4>
        @foreach ($list_tree as $node)
            <p>{{$node}}</p>
        @endforeach
        </div> 

        <div>
            <h4>иерархия</h4>
        <?php
            function print_tree($tree){
                foreach ($tree as $parent => $children) {
                    echo "<ul><li>$parent";

                    if (count($children) > 0){
                        print_tree($children);
                    } else {
                        echo "</li>";
                    }
                    echo "</ul>";
                }                
            }
            print_tree($tree);
        ?>
        </div>

        <div>
            <h4>С указанием родителя (div_1_3)</h4>
        <?php
            print_tree($tree_div_1_3);
        ?>
        </div>
        
    </body>
</html>
