<?php
// Instantiate a new tree with root node of 5
$bst = new BST(5);

// Insert left branch nodes
$bst->insert(2);
$bst->insert(1);
$bst->insert(4);

// Insert right branch nodes
$bst->insert(11);
$bst->insert(7);
$bst->insert(23);
$bst->insert(16);
$bst->insert(34);
echo json_encode($bst, JSON_PRETTY_PRINT);
echo "\n";
echo json_encode($bst->search(17), JSON_PRETTY_PRINT);
echo "\n";
echo json_encode($bst->min(), JSON_PRETTY_PRINT);
echo "\n";
echo json_encode($bst->max(), JSON_PRETTY_PRINT);
// Walk the tree
$tree = $bst->walk();
foreach ($tree as $node) {
    // echo "{$node->value}\n";
}

class Node
{
    public $value, $left, $right;

    public function __construct($value)
    {
        $this->value = $value;
    }
}
class BST
{
    public $root;

    public function __construct($value = null)
    {
        if ($value !== null) {
            $this->root = new Node($value);
        }
    }

    public function search($value)
    {
        $node = $this->root;

        while ($node) {
            if ($value > $node->value) {
                $node = $node->right;
            } elseif ($value < $node->value) {
                $node = $node->left;
            } else {
                break;
            }
        }

        return $node;
    }

    public function insert($value)
    {
        $node = $this->root;
        if (!$node) {
            return $this->root = new Node($value);
        }

        while ($node) {
            if ($value > $node->value) {
                if ($node->right) {
                    $node = $node->right;
                } else {
                    $node = $node->right = new Node($value);
                    break;
                }
            } elseif ($value < $node->value) {
                if ($node->left) {
                    $node = $node->left;
                } else {
                    $node = $node->left = new Node($value);
                    break;
                }
            } else {
                break;
            }
        }
        return $node;
    }
    public function min()
    {
        $node = $this->root;
        while ($node->left) {
            if (!$node->left) {
                break;
            }
            $node = $node->left;
        }
        return $node;
    }
    public function max()
    {
        $node = $this->root;
        while ($node->right) {
            if (!$node->right) {
                break;
            }
            $node = $node->right;
        }
        return $node;
    }
    public function walk(Node $node = null)
    {
        if (!$node) {
            $node = $this->root;
        }
        if (!$node) {
            return false;
        }
        if ($node->left) {
            yield from $this->walk($node->left);
        }
        yield $node;
        if ($node->right) {
            yield from $this->walk($node->right);
        }
    }
}
