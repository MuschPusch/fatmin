<?php

/**
 * @file
 * Template for invoiced orders.
 */
?>

<link type="text/css" rel="stylesheet" href="/sites/all/themes/shiny/css/pdf.css" media="all">

<div class="Page">
  <div class="Pdf-invoiced">
    <div class="Logo">
      <!-- <img class="Logo-image" src="https://unsplash.it/500/700?image=63"> -->
      <img class="Logo-image" src="http://ci.factorial.io/logo-300/1/random/color/logo.png">
      <!-- img class="Logo-image" src="<?php print $content['invoice_logo']['#value']; ?>"/-->
      <!-- <div class="Logo-image"><strong>Factorial</strong> GmbH</div> -->
    </div>
    <div class="Header">
      <br />
      <?php print render($content['commerce_customer_billing']); ?><br>
    </div>

    <div class="Meta">
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <div class="Meta-id">
        <br />
        <?php print render($content['plain_order_number']); ?><br>
      </div>
      <div class="Meta-date">
        <br />
        <?php print render($content['invoice_date']); ?><br>
      </div>
    </div>

    <div class="Content">
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <div class="lineItems"><?php print render($content['commerce_line_items']); ?></div>
      <div class="OrderTotal"><?php print render($content['commerce_order_total']); ?></div>
      <br>
      <br>
      <br>
      <div class="AdditionalText">
        <?php print render($content['field_additional_info']); ?>
      </div>
      <br>
      <br>
      <div class="InvoiceText">
        Das Lieferdatum entspricht dem Rechnungsdatum, falls nichts anderes angegeben ist. Bitte überweisen Sie den Rechnungsbetrag innerhalb der nächsten 14 Tage, spätestens zum <?php print render($content['due_date']); ?>.<br>
        <br>
        Wir danken für Ihren Auftrag.
      </div>

      <div class="LineNumers">
        01<br>
        02<br>
        03<br>
        04<br>
        05<br>
        06<br>
        07<br>
        08<br>
        09<br>
        10<br>
        11<br>
        12<br>
        13<br>
        14<br>
        15<br>
        16<br>
        17<br>
        18<br>
        19<br>
        20<br>
        21<br>
        22<br>
        23<br>
        24<br>
        25<br>
        26<br>
        27<br>
        28<br>
        29<br>
        30<br>
        31<br>
        32<br>
        33<br>
        34<br>
        35<br>
        36<br>
        37<br>
        38<br>
        39<br>
        40<br>
        41<br>
        42<br>
        43<br>
        44<br>
        45<br>
        46<br>
        47<br>
        48
      </div>
    </div>


    <div class="Sidebar">
      <br>
      Factorial GmbH<br>
      Blücherstraße <span class="nr">11</span><br>
      22767 Hamburg<br>
      <br>
      <span class="nr">+49 40 41 30 67 97</span><br>
      hello@factorial.io<br>
      factorial.io<br>
      <br>
      <strong>Sitz der Gesellschaft</strong>
      Hamburg<br>
      <br>
      <strong>Registergericht</strong>
      Amtsgericht Hamburg<br>
      HRB <span class="nr">134670</span><br>
      <br>
      <strong>Geschäftsführer</strong>
      Volkan Flörchinger<br>
      Stephan Huber<br>
      Milan Matull<br>
      <br>
      <strong>UST-ID</strong>
      DE <span class="nr">298 155 819</span><br>
      <br>
      <strong>Steuernummer</strong>
      <span class="nr">41/720/02949</span><br>
      <br>
      <strong>Bankverbindung</strong>
      Hamburger Sparkasse<br>
      <span class="nr">DE59 2005 0550 1002 2032 61</span><br>
      <span class="nr">HASPDEHHXXX</span>
    </div>

    <div class="CompanyName">
      <img src="http://factorial.io/images/logo-factorial.png" alt="">
    </div>
  </div>
</div>
