@push('scripts')
  <script src="{{asset("js/dropzone.js")}}"></script>
  <link rel="stylesheet" href="{{asset('css/dropzone.css')}}">
  <script type="text/javascript">
  // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
  var previewNode = document.querySelector("#template");
  previewNode.id = "";
  var previewTemplate = previewNode.parentNode.innerHTML;
  previewNode.parentNode.removeChild(previewNode);

  var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "/admin/image", // Set the url
    headers: {'X-CSRF-TOKEN':"{{ csrf_token() }}"},
    params: [{'id': "100"}],
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
  });

  myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() {
      myDropzone.enqueueFile(file);
    };
  });

  // Update the total progress bar
  myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
  });

  myDropzone.on("sending", function(file, xhr, formData) {
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1";
    // And disable the start button
    formData.append('id', 'bob');
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
  });

  // Hide the total progress bar when nothing's uploading anymore
  myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0";
  });

  // Setup the buttons for all transfers
  // The "add files" button doesn't need to be setup because the config
  // `clickable` has already been specified.
  document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
  };
  document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true);
  };
  </script>

  <style media="screen">
  #actions {
    margin: 2em 0;
  }
  /* Mimic table appearance */
  .table {
    display: table;
  }
  .table .file-row {
    display: table-row;
  }
  div.table .file-row > div {
    display: table-cell;
    vertical-align: top;
    border-top: 1px solid #ddd;
    padding: 8px;
  }
  div.table .file-row:nth-child(odd) {
    background: #f9f9f9;
  }

  /* The total progress gets shown by event listeners */
  #total-progress {
    opacity: 0;
    transition: opacity 0.3s linear;
  }

  /* Hide the progress bar when finished */
  #previews .file-row.dz-success .progress {
    opacity: 0;
    transition: opacity 0.3s linear;
  }

  /* Hide the delete button initially */
  #previews .file-row .delete {
    display: none;
  }

  /* Hide the start and cancel buttons and show the delete button */

  #previews .file-row.dz-success .start,
  #previews .file-row.dz-success .cancel {
    display: none;
  }
  #previews .file-row.dz-success .delete {
    display: block;
  }
  </style>
@endpush


  <div id="actions" class="row">

        <div class="col-lg-12">
          <!-- The fileinput-button span is used to style the file input field as button -->
          <span class="btn btn-success fileinput-button dz-clickable">
              <i class="fa fa-plus"></i>
              <span>Agregar archivos</span>
          </span>
          <button type="submit" class="btn btn-primary start">
              <i class="fa fa-upload"></i>
              <span>Subir</span>
          </button>
          <button type="reset" class="btn btn-warning cancel" >
              <i class="fa fa-times-circle-o"></i>
              <span>Cancelar</span>
          </button>
        </div>

        <div class="col-lg-5">

          <span class="fileupload-process">
            <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
              <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress=""></div>
            </div>
          </span>
        </div>

      </div>

<!-- Dropzone Preview Template -->
<div class="table table-striped" class="files row" id="previews">

 <div id="template" class="file-row">

<div>
    <span class="preview"><img data-dz-thumbnail /></span>
</div>

<div>
    <p class="name" data-dz-name></p>
    <p class="size small bold" data-dz-size></p>
    <strong class="error text-danger" data-dz-errormessage></strong>
</div>
<div>

    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
      <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
    </div>
</div>
<div>
  <button class="btn btn-primary start">
      <i class="fa fa-upload"></i>
      <span>Start</span>
  </button>
  <button data-dz-remove class="btn btn-warning cancel">
      <i class="fa fa-times-circle-o"></i>
      <span>Cancel</span>
  </button>
  <button data-dz-remove class="btn btn-danger delete">
    <i class="fa fa-trash"></i>
    <span>Delete</span>
  </button>
</div>
</div>

</div>
