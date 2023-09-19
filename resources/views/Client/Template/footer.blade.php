<div style="margin-top: 24%;" style="position: fixed;">
  <footer class="text-center text-white" style="background-color: #F3F6F9;">
    <div class="container pt-800">
      <!-- Section: Social media -->
      <section class="mb-500">
        <!-- Facebook -->

        @foreach ($sosmed as $medsos)

        <a
          class="btn btn-link btn-floating btn-lg text-dark m-1"
          href="https://wa.me/62{{ $medsos->wa }}"
          role="button"
          data-mdb-ripple-color="dark" target="_blank">
          <i class="fa-brands fa-whatsapp"></i>
        </a>

        @endforeach

        <!-- Twitter -->
        @foreach ($sosmed as $medsos)
        
        <a
        class="btn btn-link btn-floating btn-lg text-dark m-1"
        href="https://instagram.com/{{ $medsos->ig }}"
        role="button"
        data-mdb-ripple-color="dark" target="_blank">
        <i class="fa-brands fa-instagram"></i>
      </a>
      
      @endforeach
      <!-- Google -->
      
      @foreach ($sosmed as $medsos)

        <a
          class="btn btn-link btn-floating btn-lg text-dark m-1"
          href="mailto:{{ $medsos->email }}"
          role="button"
          data-mdb-ripple-color="dark" target="_blank">
          <i class="fa-regular fa-envelope"></i>
        </a>

        @endforeach

      </section>
      <!-- Section: Social media -->
    </div>

    <div class="text-center text-dark p-3" style="background-color: #E1ECF8;">
      © Copyright 2023
      <a class="text-dark" href="/">PROREQ</a>
    </div>
  </footer>
</div>
