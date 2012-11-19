<?php 

function buildTree(array $dataset)
{
    $tree = array();
 
    /* Most datasets in the wild are enumerative arrays and we need associative array
       where the same ID used for addressing parents is used. We make associative
       array on the fly */
    $references = array();
    foreach ($dataset as $id => &$node) {
        // Add the node to our associative array using it's ID as key
        $references[$node['id']] = &$node;
 
        // Add empty placeholder for children
        $node['children'] = array();
 
        // It it's a root node, we add it directly to the tree
        if (is_null($node['parentId'])) {
            $tree[$node['id']] = &$node;
        } else {
            // It was not a root node, add this node as a reference in the parent.
            $references[$node['parentId']]['children'][$node['id']] = &$node;
        }
    }
 
    return $tree;
}