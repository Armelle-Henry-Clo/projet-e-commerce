<?php

function add(int $id) 
//pour ajouter au panier un produit d'après son identifiant
{
    $panier =$_SESSION['cart'];
    //si le panier n'est pas vide, on ajoute au panier:
//    $test=array(
//      2=>2,
//      3=>1,
//    );

    if(!empty($panier[$id])):
        $panier[$id]++;
    // sinon on initialise la qutté à 1: 
    else:
        $panier[$id]=1;
    endif;
    // Enfin, on réaffecte la session: 
    $_SESSION['cart']=$panier;
}

function remove(int $id) 
//pour supprimer un produit du panier
{
    $panier =$_SESSION['cart'];
    //si le panier n'est pas vide ET supérieur à 1, on supprime du panier:
    
    //    $test=array(
//      2=>2,
//      3=>1,
//    );
    if(!empty($panier[$id]) && $panier[$id]!==1):
        $panier[$id]--;
    // sinon on supprime une entrée (ici le panier) spécifiquement grace à la fonction unset: 
    else:
        unset($panier[$id]);
    endif;
    // Enfin, on réaffecte la session: 
    $_SESSION['cart']=$panier;
}

function delete(int $id) 
//pour supprimer un produit du panier
{
    $panier =$_SESSION['cart'];
    //si le panier n'est pas vide, on supprime (unset) le panier:
    if(!empty($panier[$id])):
        unset($panier[$id]);
    endif;
    // Enfin, on réaffecte la session: 
    $_SESSION['cart']=$panier;
}

function destroy()
{
    unset($_SESSION['cart']);
}



function getFullCart()
{
    $panier = $_SESSION['cart'];

    $panierDetail = [];

    foreach($panier as $id=>$quantity):
        
            $resultat=executeRequete("SELECT * FROM product WHERE id= :id", array(':id'=>$id
        ));

        $product=$resultat ->fetch(PDO::FETCH_ASSOC);
        $panierDetail[]=[
            'product'=>$product,
            'quantity'=>$quantity,

            'total'=>$quantity * $product['price'],

        ];

    endforeach;

    return $panierDetail;

}

function getTotal()
{
    $total =0;
    foreach(getFullCart() as $item):

        $total += $item['total'];

    endforeach;

    return $total;


}

function getQuantity()
{

    $total =0;
    foreach(getFullCart() as $item):

        $total += $item['quantity'];

    endforeach;

    return $total;



}


?>