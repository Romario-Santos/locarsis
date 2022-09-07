<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Lista de Produtos
  </h1>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Editar Produto</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/admin/products/<?php echo htmlspecialchars( $product["idproduct"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="form-group">
              <label for="desproduct">Nome da produto</label>
              <input type="text" class="form-control" id="desproduct" name="desproduct" placeholder="Digite o nome do produto" value="<?php echo htmlspecialchars( $product["desproduct"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
            <div class="form-group">
              <label for="vlprice">Preço</label>
              <input type="number" class="form-control" id="vlprice" name="vlprice" step="0.01" placeholder="0.00" value="<?php echo htmlspecialchars( $product["vlprice"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>



 <div class="form-group">
              <label for="vlweight">Numero de Serie</label>
              <input type="text" class="form-control" id="vlweight" name="desns" value="<?php echo htmlspecialchars( $product["desns"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
           <div class="form-group">
<label>Fornecedor</label>
<select name="desfornecedor" class="form-control">
<option value="<?php echo htmlspecialchars( $product["desfornecedor"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $product["desfornecedor"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
<option value="DELL" >DELL</option>
<option value="LENOVO">LENOVO</option>
<option value="HP">HP</option>
<option value="BEMATECH">BEMATECH</option>
<option value="ELGIN">ELGIN</option>
</select>
</div>
<div class="form-group">
<label>Staus</label>
<select name="desstatus" class="form-control">
<option value="<?php echo htmlspecialchars( $product["desstatus"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $product["desstatus"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
<option value="ESTOQUE" >ESTOQUE</option>
<option value="MANUTENÇÂO">MANUTENÇÂO</option>
<option value="ALUGADO">ALUGADO</option>
</select>
</div>

<div class="form-group">
<label>Ram</label>
<select name="desram" class="form-control">
  <option value="<?php echo htmlspecialchars( $product["desram"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $product["desram"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
<option value="4" >4</option>
<option value="8">8</option>
<option value="16">16</option>
<option value="16">24</option>
<option value="16">32</option>
</select>
</div>
<div class="form-group">
<label>Processador</label>
<select name="desprocessador" class="form-control">
  <option value="<?php echo htmlspecialchars( $product["desprocessador"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $product["desprocessador"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
<option value="Intel i3 10ª" >Intel i3 10ª</option>
<option value="Intel i3 11ª">Intel i3 11ª</option>
<option value="Intel i3 12ª">Intel i3 12ª</option>
<option value="Intel i5 10ª">Intel i5 10ª</option>
<option value="Intel i5 11ª">Intel i5 11ª</option>
<option value="Intel i5 12ª">Intel i5 12ª</option>
<option value="Intel i7 10ª">Intel i7 10ª</option>
<option value="Intel i7 11ª">Intel i7 11ª</option>
<option value="Intel i7 12ª">Intel i7 12ª</option>
</select>
</div>
<div class="form-group"><label>Tipo de Disco</label></div>
<div class="radio">
<label>
<input type="radio" name="destipodisco" id="optionsRadios1" value="SSD NVME" <?php if( $product["destipodisco"] == 'SSD NVME' ){ ?>checked<?php } ?>>
SSD NVME
</label>
</div>
<div class="radio">
<label>
<input type="radio" name="destipodisco" id="optionsRadios2" value="SSD M2" <?php if( $product["destipodisco"] == 'SSD M2' ){ ?>checked<?php } ?>>
SSD M2
</label>
</div>
<div class="radio">
<label>
<input type="radio" name="destipodisco" id="optionsRadios3" value="SSD SATA" <?php if( $product["destipodisco"] == 'SSD SATA' ){ ?>checked<?php } ?>>
SSD SATA
</label>
</div>
<div class="radio">
<label>
<input type="radio" name="destipodisco" id="optionsRadios4" value="HD" <?php if( $product["destipodisco"] == 'HD' ){ ?>checked<?php } ?>>
HD
</label>
</div>

<div class="form-group">
<label>Tamanho Do Disco</label>
<select name="destamanhodisco" class="form-control">
<option value="<?php echo htmlspecialchars( $product["destamanhodisco"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $product["destamanhodisco"], ENT_COMPAT, 'UTF-8', FALSE ); ?> GB</option>
<option value="110" >110 GB</option>
<option value="256">256 GB</option>
<option value="480">480 GB</option>
<option value="1000">1 TB</option>
<option value="2000">2 TB</option>
</select>


            <div class="form-group">
              <label for="vlwidth">Largura</label>
              <input type="number" class="form-control" id="vlwidth" name="vlwidth" step="0.01" placeholder="0.00" value="<?php echo htmlspecialchars( $product["vlwidth"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
            <div class="form-group">
              <label for="vlheight">Altura</label>
              <input type="number" class="form-control" id="vlheight" name="vlheight" step="0.01" placeholder="0.00" value="<?php echo htmlspecialchars( $product["vlheight"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
            <div class="form-group">
              <label for="vllength">Comprimento</label>
              <input type="number" class="form-control" id="vllength" name="vllength" step="0.01" placeholder="0.00" value="<?php echo htmlspecialchars( $product["vllength"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
            <div class="form-group">
              <label for="vlweight">Peso</label>
              <input type="number" class="form-control" id="vlweight" name="vlweight" step="0.01" placeholder="0.00" value="<?php echo htmlspecialchars( $product["vlweight"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
            <div class="form-group">
              <label for="vlweight">Url</label>
              <input type="text" class="form-control" id="vlweight" name="desurl" value="<?php echo htmlspecialchars( $product["desurl"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
          </div>
           <div class="form-group">
              <label for="file">Foto</label>
              <input type="file" class="form-control" id="file" name="file" value="<?php echo htmlspecialchars( $product["vlweight"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              <div class="box box-widget">
                <div class="box-body">
                  <img class="img-responsive" id="image-preview" src="<?php echo htmlspecialchars( $product["desphoto"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" alt="Photo">
                </div>
              </div>
            </div>
          </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Salvar</button>
          </div>
        </form>
      </div>
  	</div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
document.querySelector('#file').addEventListener('change', function(){
  
  var file = new FileReader();

  file.onload = function() {
    
    document.querySelector('#image-preview').src = file.result;

  }

  file.readAsDataURL(this.files[0]);

});
</script>