<style>
.counters {
	background: #145C97;
	color: #fff;
	padding: 40px 20px;
	border-top: 3px lightskyblue solid;
    border-radius: 1rem;
}

.counters .container {
	display: grid;
	grid-template-columns: repeat(4, 1fr);
	grid-gap: 20px;
	text-align: center;
}

.counters i {
	color: lightskyblue;
	margin-bottom: 5px;
}

.counters .counter {
	font-size: 25px;
	margin: 10px 0;
}

@media (max-width: 700px) {
	.counters .container {
		grid-template-columns: repeat(2, 1fr);
	}

	.counters .container > div:nth-of-type(1),
	.counters .container > div:nth-of-type(2) {
		border-bottom: 1px lightskyblue solid;
		padding-bottom: 10px;
	}
}
.box {
  display: inline-block;
  width: 50px;
  height: 50px;
  border: 1px solid rgba(0, 0, 0, .2);
}

.blue {
  background: #13b4ff;
}

.purple {
  background: #ab3fdd;
}

.wine {
  background: #ae163e;
}

</style>
<div class="col-md-4">
        <!-- Sidebar -->
        <div class="card mb-4">
          <div class="card-header">
            Kategori
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item"><a href="{{ route('berita.show_all') }}">Berita({{ $totalberita }})</a></li>
            <li class="list-group-item"><a href="{{ route('pengumuman.show_all') }}">Pengumuman({{ $totalpengumuman }})</a></li>
          </ul>
        </div>

        <div class="card mb-4" style="height:590px">
          <div class="card-header">
            Info Kabupaten Probolinggo
          </div>
          <div class="card-body" id="fb_prob">
            <!-- Facebook Page Plugin -->
            <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FInfokabprobolinggo&tabs=timeline&width=445&height=500&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=false&appId=346654799660055" width="445" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
          </div>
        </div>

        <div class="card mb-4" style="height:670px">
        <div class="card-header">
            Government Public Relations (GPR)
        </div>
          <div class="card-body">
            <script type="text/javascript" src="https://widget.kominfo.go.id/gpr-widget-kominfo.min.js"></script>
            <div id="gpr-kominfo-widget-container"></div>
          </div>
        </div>


      </div>
    </div>
  </div>

  <!-- "Go to Top" button -->
  <button id="goToTop" onclick="scrollToTop()"><i class="fas fa-arrow-up"></i></button>
