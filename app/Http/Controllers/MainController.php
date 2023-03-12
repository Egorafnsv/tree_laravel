<?php

namespace App\Http\Controllers;

use App\Models\Directory;
use Illuminate\Http\Request;

class MainController extends Controller
{
    
    public function getIndexPage(){

        $tree = $this->getTree();
        $tree_div_1_3 = $this->getTree(7);

        $list_tree = [];
        $this->unpackToList($tree, $list_tree);

        return view('welcome', 
        [
            'tree' => $tree,
            'list_tree' => $list_tree,
            'tree_div_1_3' => $tree_div_1_3,
        ]);
    }

    private function getTree($parent_id = null){ // $parent_id - id директории, потомков которой нужно вывести, null - всех
        // получим только те узлы, у которых нет родительского элемента

        $directories = Directory::select("id", "name")
        ->leftJoin("relations", "directories.id", "relations.child_id")
        ->where("relations.parent_id", "=", $parent_id)->get();

        $tree = [];

        foreach ($directories as $dir) {
            $this->createTree($dir, $tree);
        }
        
        return $tree;
    }

    private function createTree($dir, &$tree){
            $tree[$dir->name] = [];
            if(count($dir->subdirectories) > 0){
                foreach($dir->subdirectories as $subdir){
                    $name_subdir = Directory::find($subdir->child_id)->name;
                    $tree[$dir->name][$name_subdir] = [];
                    $this->createTree(Directory::where("name", $name_subdir)->first(), $tree[$dir->name]);
            }
        }
    }

    private function unpackToList($tree, &$list){
        foreach ($tree as $parent => $children){
            $list[] = $parent;
            if (count($children) > 0) $this->unpackToList($children, $list);
        }
    }
}