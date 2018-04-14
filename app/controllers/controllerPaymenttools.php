<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if ($args->args['getpaymentmode']=="1"){
    $payment=new Payment($args->args['getpayment']['id']);
    $data['paymentdetail']['id']=$payment->id;
    $data['paymentdetail']['date']=$payment->date;
    $data['paymentdetail']['napravlenie']['id']=$payment->napravlenie;
    $data['paymentdetail']['napravlenie']['name']=$payment->napravlenie_name;
    $data['paymentdetail']['category']['id']=$payment->category_id;
    $data['paymentdetail']['category']['name']=$payment->category_name;
    $data['paymentdetail']['subcategory']['id']=$payment->subcategory_id;
    $data['paymentdetail']['subcategory']['name']=$payment->subcategory_name;
    $data['paymentdetail']['money']=$payment->money;
}
if ($args->args['editpaymentmode']=="1"){
    $payment=new Payment($args->args['editpayment']['id']);
    $payment->edit($args->args['editpayment']['money'], $args->args['editpayment']['date'], $args->args['editpayment']['napravlenie'], $args->args['editpayment']['category'], $args->args['editpayment']['subcategory']);
}
if ($args->args['deletepaymentmode']=="1"){
    $payment=new Payment($args->args['deletepayment']['id']);
    echo $payment->id;
    $payment->delete();
}