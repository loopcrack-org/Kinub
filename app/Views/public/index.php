<?php $this->extend('public/templates/layout'); ?>

<!-- CSS -->
<?php $this->section('css'); ?>
<link rel="stylesheet" href="assets/public/css/home.min.css" type="text/css">
<?php $this->endSection(); ?>

<!-- JS -->
<?php $this->section('js'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="assets/public/js/home.min.js"></script>
<?php $this->endSection(); ?>


<?php $this->section('content'); ?>
<?php $errors = session()->get('errors'); ?>

<section class="about-us">
    <div class="about-us__grid">
        <div class="about-us__image-container">
            <picture>
                <source srcset="assets/images/home-about-us.avif" type="image/avif">
                <source srcset="assets/images/home-about-us.webp" type="image/webp">
                <img class="about-us__image" loading="lazy" src="assets/images/home-about-us.jpg" alt="About us image">
            </picture>
        </div>

        <div class="about-us__content">
            <h2 class="about-us__heading title--level-2">Nosotros</h2>
            <p class="about-us__text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero dolor itaque sit nesciunt nihil maiores placeat sequi recusandae earum voluptatibus accusantium modi natus dolorem, tenetur, quod reprehenderit nostrum. Error, sit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis, illum saepe ab, sit iure dignissimos</p>
        </div>
    </div>
</section>

<section class="kinub-video">
    <div class="kinub-video__container">
        <video
        id="kinub-video"
        class="kinub-video__video"
        preload="auto"
        width="500"
        height="264"
        muted
        autoplay
        playsinline
        controls
        >
            <source src="assets/video/kinub-video-example.mp4" type="video/mp4" />
            <source src="assets/video/kinub-video-example.webm" type="video/webm" />
        </video>
    </div>
</section>

<section class="measurement-solutions">
    <h3 class="measurement-solutions__heading title--level-3">Soluciones de medición</h3>

    <div class="measurement-solutions__grid">
        <div class="measurement-solution" style="background-image: url('assets/images/auth-one-bg.jpg');">
            <div class="measurement-solution__icon">

                <svg viewBox="0 0 295 343" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M166.068 243.566C166.168 243.566 166.268 243.566 166.358 243.566C168.758 243.486 170.978 242.486 172.618 240.736L189.548 222.686C192.928 219.076 192.748 213.386 189.138 210.006L124.178 149.076C122.428 147.436 120.148 146.576 117.748 146.656C115.348 146.736 113.128 147.736 111.488 149.486L94.5576 167.536C91.1776 171.146 91.3576 176.836 94.9676 180.216L159.928 241.146C161.608 242.706 163.778 243.566 166.068 243.566ZM118.078 156.506L182.108 216.566L166.048 233.686L102.018 173.626L118.078 156.506Z" fill="url(#paint0_linear_2_97)"/>
                    <path d="M112.788 262.306C121.478 265.986 130.708 267.846 140.218 267.846C149.728 267.846 158.958 265.986 167.648 262.306C176.038 258.756 183.568 253.676 190.038 247.206C196.508 240.736 201.588 233.206 205.138 224.816C208.818 216.126 210.678 206.896 210.678 197.386C210.678 187.876 208.818 178.646 205.138 169.956C201.588 161.566 196.508 154.036 190.038 147.566C183.568 141.096 176.038 136.016 167.648 132.466C158.958 128.786 149.728 126.926 140.218 126.926C130.708 126.926 121.478 128.786 112.788 132.466C104.398 136.016 96.8677 141.096 90.3977 147.566C83.9277 154.036 78.8477 161.566 75.2977 169.956C71.6177 178.646 69.7577 187.876 69.7577 197.386C69.7577 206.896 71.6177 216.126 75.2977 224.816C78.8477 233.206 83.9277 240.736 90.3977 247.206C96.8677 253.676 104.398 258.756 112.788 262.306ZM140.218 136.546C173.768 136.546 201.068 163.846 201.068 197.396C201.068 230.946 173.768 258.246 140.218 258.246C106.668 258.246 79.3677 230.946 79.3677 197.396C79.3677 163.846 106.668 136.546 140.218 136.546Z" fill="url(#paint1_linear_2_97)"/>
                    <path d="M293.718 120.775C292.088 110.645 287.978 98.9855 281.818 87.0655C275.448 74.7255 267.198 62.5255 257.318 50.7955C243.978 34.9655 229.078 21.7755 214.238 12.6455C199.188 3.38548 185.428 -0.924521 174.448 0.165479C170.298 0.575479 166.468 2.30548 163.388 5.14548C160.328 7.96548 158.288 11.6255 157.508 15.7255L148.408 62.9355C147.538 67.4355 149.018 71.9955 152.368 75.1255L182.288 103.115L173.668 112.285L157.668 97.2755C151.458 91.4455 143.348 88.3855 134.838 88.6655C126.328 88.9355 118.428 92.5055 112.598 98.7255L34.9876 181.455C33.1676 183.395 33.2676 186.435 35.2076 188.245C37.1476 190.065 40.1876 189.965 41.9976 188.025L119.608 105.295C123.678 100.955 129.198 98.4655 135.138 98.2755C141.088 98.0855 146.748 100.225 151.088 104.295L235.058 183.065C239.398 187.135 241.888 192.655 242.078 198.595C242.268 204.545 240.128 210.205 236.058 214.545L132.098 325.355C123.698 334.315 109.568 334.765 100.608 326.365L16.6376 247.595C12.2976 243.525 9.80765 238.005 9.61765 232.065C9.42765 226.115 11.5676 220.455 15.6376 216.115C17.4576 214.175 17.3576 211.135 15.4176 209.325C13.4776 207.505 10.4376 207.605 8.62765 209.545C2.79765 215.755 -0.262353 223.865 0.017647 232.375C0.287647 240.885 3.85765 248.785 10.0776 254.615L94.0477 333.385C100.008 338.975 107.708 342.016 115.838 342.016C116.188 342.016 116.538 342.005 116.878 341.995C125.388 341.725 133.288 338.155 139.118 331.945L243.068 221.125C248.898 214.915 251.958 206.805 251.678 198.295C251.408 189.785 247.838 181.885 241.618 176.055L218.368 154.245L227.488 145.425L260.908 176.695C263.408 179.035 266.618 180.285 269.928 180.275C271.108 180.275 272.298 180.115 273.478 179.795C277.958 178.565 281.408 175.165 282.698 170.705L292.758 136.005C294.188 131.065 294.518 125.795 293.718 120.775ZM212.018 148.275L180.668 118.865L189.298 109.685L221.128 139.465L212.018 148.275ZM283.528 133.335L273.478 168.025C272.968 169.795 271.538 170.365 270.938 170.525C270.718 170.585 270.358 170.655 269.938 170.655C269.228 170.655 268.318 170.455 267.478 169.665L158.928 68.1055C158.008 67.2455 157.598 65.9855 157.838 64.7555L166.938 17.5455C167.748 13.3655 171.228 10.1455 175.398 9.73548C176.198 9.65548 177.018 9.61548 177.868 9.61548C186.338 9.61548 197.338 13.5355 209.198 20.8355C223.178 29.4355 237.278 41.9355 249.968 56.9955C268.348 78.8055 281.158 103.215 284.218 122.305C284.808 125.935 284.568 129.745 283.528 133.335Z" fill="url(#paint2_linear_2_97)"/>
                    <defs>
                    <linearGradient id="paint0_linear_2_97" x1="92.1486" y1="195.098" x2="191.974" y2="195.098" gradientUnits="userSpaceOnUse">
                    <stop offset="0.000558651" stop-color="#00599D"/>
                    <stop offset="0.5397" stop-color="#58B5E0"/>
                    <stop offset="1" stop-color="#0085A0"/>
                    </linearGradient>
                    <linearGradient id="paint1_linear_2_97" x1="69.7588" y1="197.39" x2="210.671" y2="197.39" gradientUnits="userSpaceOnUse">
                    <stop offset="0.000558651" stop-color="#00599D"/>
                    <stop offset="0.5397" stop-color="#58B5E0"/>
                    <stop offset="1" stop-color="#0085A0"/>
                    </linearGradient>
                    <linearGradient id="paint2_linear_2_97" x1="-0.00235301" y1="171.005" x2="294.147" y2="171.005" gradientUnits="userSpaceOnUse">
                    <stop offset="0.000558651" stop-color="#00599D"/>
                    <stop offset="0.5397" stop-color="#58B5E0"/>
                    <stop offset="1" stop-color="#0085A0"/>
                    </linearGradient>
                    </defs>
                </svg>

            </div>

            <div class="measurement-solution__content">
                <p class="measurement-solution__title"><span class="measurement-solution__title--strong">Medidores</span> Residenciales</p>
                <p class="measurement-solution__description">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, morbi quis tempor odio.
                </p>
            </div>

            <div class="measurement-solution__mask"></div>
            <div class="measurement-solution__mask--hover"></div>
        </div>

        <div class="measurement-solution" style="background-image: url('assets/images/auth-one-bg.jpg');">
            <div class="measurement-solution__icon">

                <svg viewBox="0 0 250 349" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M238.27 205.48C230.44 188.37 219.49 178.94 207.43 178.94H189.43C179 178.94 169.39 186 161.93 198.98H148.26V177.53H160.91C169.44 177.53 176.45 170.43 177.02 161.47C177.51 161.53 178.01 161.56 178.51 161.56H201.59C208.78 161.56 214.63 155.71 214.63 148.52V144.69C214.63 137.5 208.78 131.65 201.59 131.65H197.88V119.05H197.84C197.84 117.47 197.39 115.1 195.24 112.75C194.08 111.48 192.55 110.34 190.57 109.29C188.34 108.1 185.49 107 182.06 106V18.8C182.06 8.43 173.63 0 163.26 0H89.25C78.88 0 70.45 8.43 70.45 18.8C70.45 22 73.04 24.59 76.24 24.59C79.44 24.59 82.03 22 82.03 18.8C82.03 14.82 85.27 11.58 89.25 11.58H163.27C167.25 11.58 170.49 14.82 170.49 18.8V122.96C169.66 123.12 168.8 123.27 167.89 123.43C156.31 125.41 141.5 126.5 126.18 126.5C110.86 126.5 96.05 125.41 84.47 123.43C83.62 123.28 82.81 123.14 82.03 122.99V54.17C82.03 50.97 79.44 48.38 76.24 48.38C73.04 48.38 70.45 50.97 70.45 54.17V105.93C66.96 106.94 64.05 108.05 61.79 109.24C59.79 110.3 58.25 111.43 57.07 112.71C54.9 115.07 54.44 117.46 54.44 119.05C54.44 119.29 54.46 119.52 54.48 119.75V131.66H53.58C46.39 131.66 40.54 137.51 40.54 144.7V148.53C40.54 155.72 46.39 161.57 53.58 161.57H76.66C77.16 161.57 77.66 161.54 78.15 161.48C78.72 170.44 85.73 177.54 94.26 177.54H102.37V198.99H93.93C84.6 182.5 72.02 178.95 62.92 178.95H44.15C37.58 178.95 31.32 181.39 25.52 186.2C20.34 190.5 15.75 196.54 11.87 204.16C4.21 219.18 0 239.02 0 260.03C0 281.04 4.21 300.88 11.86 315.9C15.74 323.52 20.34 329.57 25.51 333.86C31.31 338.67 37.57 341.11 44.14 341.11H62.93C74 341.11 84.35 334.02 92.31 321.07H158.13C158.28 321.41 158.43 321.75 158.58 322.08C166.41 339.19 177.36 348.62 189.42 348.62H207.42C219.48 348.62 230.43 339.2 238.26 322.08C245.43 306.41 249.38 285.7 249.38 263.77C249.38 241.84 245.44 221.15 238.27 205.48ZM203.05 144.7V148.53C203.05 149.33 202.4 149.98 201.6 149.98H179.78C183.63 148.98 186.85 147.87 189.4 146.66C191.55 145.64 193.3 144.5 194.63 143.24H201.6C202.4 143.24 203.05 143.9 203.05 144.7ZM182.07 118.18C182.93 118.5 183.64 118.8 184.22 119.07C183.64 119.34 182.92 119.64 182.07 119.96V118.18ZM126.18 138.08C144.16 138.08 161.11 136.66 173.92 134.09C178.8 133.11 182.94 131.99 186.29 130.74V133.05C185.35 133.86 184.67 134.96 184.39 136.21C181.93 137.38 177.09 139.08 167.88 140.65C156.3 142.63 141.49 143.72 126.17 143.72C110.85 143.72 96.04 142.63 84.46 140.65C71.68 138.47 67.3 136.03 66.05 135.13V130.74C69.4 131.99 73.54 133.11 78.42 134.09C91.25 136.66 108.2 138.08 126.18 138.08ZM70.45 120.01C69.5 119.66 68.72 119.34 68.1 119.05C68.73 118.76 69.5 118.44 70.45 118.09V120.01ZM52.13 148.52V144.69C52.13 143.89 52.78 143.24 53.58 143.24H57.31C57.45 143.24 57.58 143.23 57.71 143.22C59.05 144.48 60.8 145.63 62.96 146.65C65.51 147.86 68.73 148.97 72.58 149.97H53.58C52.78 149.98 52.13 149.32 52.13 148.52ZM89.7 160.29V153.14C100.51 154.54 113.07 155.3 126.18 155.3C140.44 155.3 154.06 154.41 165.47 152.76V160.3C165.47 163.36 163.38 165.95 160.9 165.95H94.27C91.8 165.94 89.7 163.36 89.7 160.29ZM113.97 177.53H136.67V198.98H113.97V177.53ZM22.19 310.65C15.35 297.23 11.59 279.25 11.59 260.03C11.59 240.81 15.36 222.84 22.19 209.41C25.31 203.29 29.02 198.34 32.92 195.1C34.91 193.45 36.93 192.24 38.96 191.48C35.92 195.03 33.14 199.26 30.65 204.15C23 219.17 18.79 239.01 18.79 260.02C18.79 281.03 23 300.87 30.65 315.89C33.14 320.78 35.92 325.01 38.96 328.56C36.92 327.8 34.9 326.59 32.92 324.94C29.02 321.72 25.31 316.77 22.19 310.65ZM62.93 329.54C59.14 329.54 55.36 328 51.7 324.96C47.8 321.72 44.09 316.77 40.97 310.65C34.13 297.23 30.37 279.25 30.37 260.03C30.37 240.81 34.14 222.84 40.97 209.41C44.09 203.29 47.8 198.34 51.7 195.1C55.36 192.06 59.14 190.52 62.93 190.52C70.27 190.52 76.31 193.82 81.24 200.58C79.31 201.52 77.26 202.96 75.2 205.14C72.08 208.46 69.34 213.06 67.05 218.81C62.63 229.91 60.2 244.55 60.2 260.03C60.2 275.51 62.63 290.15 67.05 301.25C69.34 307.01 72.08 311.6 75.2 314.92C76.79 316.61 78.38 317.86 79.92 318.77C74.73 325.76 68.84 329.54 62.93 329.54ZM87.98 309.5C85.59 309.5 81.49 306.22 77.81 296.96C73.92 287.19 71.78 274.07 71.78 260.03C71.78 245.98 73.92 232.87 77.81 223.1C81.49 213.85 85.59 210.56 87.98 210.56H147.59C146.11 212.96 144.75 215.72 143.52 218.81C139.1 229.91 136.67 244.55 136.67 260.03C136.67 275.51 139.1 290.15 143.52 301.25C144.75 304.34 146.11 307.1 147.59 309.5H87.98ZM169.12 317.28C162.63 303.09 159.05 284.09 159.05 263.79C159.05 243.49 162.63 224.49 169.12 210.3C173.7 200.28 179.33 193.67 185.05 191.4C181.95 195.26 179.1 199.97 176.58 205.48C169.41 221.15 165.46 241.86 165.46 263.79C165.46 285.72 169.41 306.43 176.58 322.1C179.1 327.61 181.94 332.32 185.05 336.18C179.34 333.91 173.7 327.3 169.12 317.28ZM227.73 317.28C221.98 329.85 214.58 337.05 207.43 337.05C200.27 337.05 192.87 329.84 187.13 317.28C180.64 303.09 177.06 284.09 177.06 263.79C177.06 243.49 180.64 224.49 187.13 210.3C192.88 197.73 200.28 190.53 207.43 190.53C214.59 190.53 221.99 197.74 227.73 210.3C234.22 224.49 237.8 243.49 237.8 263.79C237.8 284.09 234.23 303.09 227.73 317.28Z" fill="url(#paint0_linear_2_95)"/>
                    <defs>
                    <linearGradient id="paint0_linear_2_95" x1="0" y1="174.32" x2="249.386" y2="174.32" gradientUnits="userSpaceOnUse">
                    <stop offset="0.000558651" stop-color="#00599D"/>
                    <stop offset="0.5397" stop-color="#58B5E0"/>
                    <stop offset="1" stop-color="#0085A0"/>
                    </linearGradient>
                    </defs>
                </svg>

            </div>

            <div class="measurement-solution__content">
                <p class="measurement-solution__title"><span class="measurement-solution__title--strong">Medidores</span> Industriales</p>
                <p class="measurement-solution__description">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, morbi quis tempor odio.
                </p>
            </div>

            <div class="measurement-solution__mask"></div>
            <div class="measurement-solution__mask--hover"></div>
        </div>

        <div class="measurement-solution" style="background-image: url('assets/images/auth-one-bg.jpg');">
            <div class="measurement-solution__icon">

                <svg viewBox="0 0 283 378" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M53.143 16.8891C59.783 14.2991 66.803 12.8491 74.013 12.5691C76.683 12.4691 78.603 11.3891 79.713 9.37912C80.873 7.28912 80.843 5.05912 79.653 3.07912C78.753 1.58912 76.943 -0.140885 73.483 0.00911542C53.233 0.989115 35.573 8.69911 22.383 22.3191C17.433 27.6291 14.273 31.6291 11.483 36.1291C3.52304 48.9891 -0.336958 63.2891 0.0230425 78.6391C0.0630425 80.3591 0.613042 81.8091 1.66304 82.9391C2.90304 84.2791 4.62304 85.0091 6.36304 85.0091C7.17304 85.0091 7.98304 84.8491 8.75304 84.5291C10.553 83.7691 12.673 81.9991 12.573 77.9591C11.903 51.1591 28.213 26.6191 53.143 16.8891Z" fill="url(#paint0_linear_2_104)"/>
                    <path d="M56.813 35.4691C61.973 32.7691 67.873 31.3091 74.843 30.9891C78.393 30.8291 81.163 28.0691 81.153 24.6991C81.143 22.9091 80.503 21.3591 79.303 20.2191C77.973 18.9691 76.043 18.3491 73.853 18.4691C56.793 19.4391 42.753 26.6391 30.923 40.4991C26.843 45.3991 23.383 51.9091 21.183 58.8191C19.193 65.0591 18.293 71.5791 18.493 78.1891C18.573 80.7191 19.843 82.7091 22.073 83.7691C22.983 84.1991 23.903 84.4191 24.813 84.4191C26.153 84.4191 27.483 83.9491 28.683 83.0291C30.973 81.2691 31.013 78.6891 31.043 77.1391C31.353 58.2791 40.023 44.2491 56.813 35.4691Z" fill="url(#paint1_linear_2_104)"/>
                    <path d="M81.8131 45.4591C81.6131 41.9491 78.5231 39.3391 74.7631 39.5391C65.0431 40.0291 56.5631 43.9191 49.5231 51.1391C42.8331 58.4991 39.4731 67.1791 39.5231 76.9191C39.5331 78.9691 40.2531 80.7891 41.5331 82.0491C42.6531 83.1491 44.1631 83.7591 45.7731 83.7591C45.8031 83.7591 45.8331 83.7591 45.8531 83.7591C49.5531 83.7091 52.0431 80.9491 52.0631 76.8791C52.1131 63.3691 61.9331 52.9491 75.4331 52.0891C79.2731 51.8291 82.0131 48.9791 81.8131 45.4591Z" fill="url(#paint2_linear_2_104)"/>
                    <path d="M263.233 126.799H98.673V80.7192C98.673 71.0292 90.793 63.1492 81.103 63.1492C71.413 63.1492 63.533 71.0292 63.533 80.7192V144.959C63.493 145.499 63.463 146.039 63.463 146.559V265.189H78.503V146.559C78.503 143.949 80.623 141.829 83.233 141.829H263.233C265.843 141.829 267.963 143.949 267.963 146.559V326.559C267.963 329.169 265.843 331.289 263.233 331.289H83.233C80.623 331.289 78.503 329.169 78.503 326.559V324.559H63.463V326.559C63.463 337.459 72.333 346.319 83.223 346.319H105.533V349.279H99.783V364.919C99.783 372.109 105.633 377.959 112.823 377.959H120.083C127.273 377.959 133.123 372.109 133.123 364.919V349.279H127.303V346.319H219.083V349.279H213.333V364.919C213.333 372.109 219.183 377.959 226.373 377.959H233.633C240.823 377.959 246.673 372.109 246.673 364.919V349.279H240.853V346.319H263.243C274.143 346.319 283.003 337.449 283.003 326.559V146.559C282.993 135.659 274.123 126.799 263.233 126.799ZM81.103 74.2492C84.673 74.2492 87.573 77.1492 87.573 80.7192V126.799H83.233C80.213 126.799 77.303 127.469 74.643 128.759V80.7192C74.633 77.1492 77.533 74.2492 81.103 74.2492ZM233.633 371.229H226.373C222.893 371.229 220.073 368.399 220.073 364.929V356.019H239.943V364.929C239.933 368.399 237.113 371.229 233.633 371.229ZM126.393 356.009V364.919C126.393 368.399 123.563 371.219 120.093 371.219H112.833C109.353 371.219 106.533 368.389 106.533 364.919V356.009H126.393ZM112.273 349.279V346.319H120.573V349.279H112.273ZM234.113 346.329V349.289H225.813V346.329H234.113Z" fill="url(#paint3_linear_2_104)"/>
                    <path d="M239.843 253.179C247.773 253.179 254.233 246.729 254.233 238.789V176.839C254.233 168.909 247.783 162.449 239.843 162.449H106.613C98.683 162.449 92.223 168.899 92.223 176.839V238.789C92.223 246.719 98.673 253.179 106.613 253.179H239.843ZM102.783 176.849C102.783 174.739 104.503 173.019 106.613 173.019H239.843C241.953 173.019 243.673 174.739 243.673 176.849V238.799C243.673 240.909 241.953 242.629 239.843 242.629H106.613C104.503 242.629 102.783 240.909 102.783 238.799V176.849Z" fill="url(#paint4_linear_2_104)"/>
                    <defs>
                    <linearGradient id="paint0_linear_2_104" x1="0" y1="42.5069" x2="80.5664" y2="42.5069" gradientUnits="userSpaceOnUse">
                    <stop offset="0.000558651" stop-color="#00599D"/>
                    <stop offset="0.5397" stop-color="#58B5E0"/>
                    <stop offset="1" stop-color="#0085A0"/>
                    </linearGradient>
                    <linearGradient id="paint1_linear_2_104" x1="18.4658" y1="51.4386" x2="81.1545" y2="51.4386" gradientUnits="userSpaceOnUse">
                    <stop offset="0.000558651" stop-color="#00599D"/>
                    <stop offset="0.5397" stop-color="#58B5E0"/>
                    <stop offset="1" stop-color="#0085A0"/>
                    </linearGradient>
                    <linearGradient id="paint2_linear_2_104" x1="39.5225" y1="61.6449" x2="81.8243" y2="61.6449" gradientUnits="userSpaceOnUse">
                    <stop offset="0.000558651" stop-color="#00599D"/>
                    <stop offset="0.5397" stop-color="#58B5E0"/>
                    <stop offset="1" stop-color="#0085A0"/>
                    </linearGradient>
                    <linearGradient id="paint3_linear_2_104" x1="63.463" y1="220.563" x2="283.008" y2="220.563" gradientUnits="userSpaceOnUse">
                    <stop offset="0.000558651" stop-color="#00599D"/>
                    <stop offset="0.5397" stop-color="#58B5E0"/>
                    <stop offset="1" stop-color="#0085A0"/>
                    </linearGradient>
                    <linearGradient id="paint4_linear_2_104" x1="92.223" y1="207.817" x2="254.237" y2="207.817" gradientUnits="userSpaceOnUse">
                    <stop offset="0.000558651" stop-color="#00599D"/>
                    <stop offset="0.5397" stop-color="#58B5E0"/>
                    <stop offset="1" stop-color="#0085A0"/>
                    </linearGradient>
                    </defs>
                </svg>

            </div>

            <div class="measurement-solution__content">
                <p class="measurement-solution__title"><span class="measurement-solution__title--strong">Medición</span> Remota</p>
                <p class="measurement-solution__description">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, morbi quis tempor odio.
                </p>
            </div>

            <div class="measurement-solution__mask"></div>
            <div class="measurement-solution__mask--hover"></div>
        </div>

        <div class="measurement-solution" style="background-image: url('assets/images/auth-one-bg.jpg');">
            <div class="measurement-solution__icon">

                <svg viewBox="0 0 225 284" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M103.888 284C93.3282 281.45 82.4582 279.79 72.2782 276.2C26.6082 260.1 -3.92177 212.22 0.408229 164.05C1.82823 148.29 8.29823 134.06 15.5582 120.3C38.4282 76.98 69.8382 40.03 102.938 4.38C104.588 2.6 106.918 1.44 108.938 0C111.038 0 113.148 0 115.248 0C122.758 7.52 130.658 14.7 137.708 22.63C163.978 52.19 188.598 83.01 207.318 118.07C217.898 137.89 225.548 158.31 223.928 181.65C220.428 232.01 175.928 278.33 125.768 282.81C123.928 282.97 122.128 283.59 120.308 284C114.828 284 109.358 284 103.888 284ZM112.098 29.03C107.768 33.9 104.068 37.92 100.538 42.06C75.5482 71.37 51.3382 101.26 33.9782 135.94C27.7482 148.38 22.2782 161.29 23.4582 175.66C26.4882 212.74 44.7282 239.82 79.3482 253.55C114.728 267.59 147.198 260.26 174.718 233.98C194.908 214.69 210.568 177.27 192.518 140.76C171.968 99.19 142.668 64.17 112.098 29.03Z" fill="url(#paint0_linear_2_111)"/>
                    <path d="M177.238 177.19C176.868 192.79 171.838 206.47 161.198 217.89C156.008 223.46 148.888 224.23 143.818 219.97C138.418 215.43 138.258 208.43 143.398 202.08C156.728 185.62 156.788 169.21 143.568 153.01C138.298 146.55 138.308 139.83 143.598 135.09C148.698 130.52 155.958 131.31 161.418 137.23C171.838 148.51 176.758 162.02 177.238 177.19Z" fill="url(#paint1_linear_2_111)"/>
                    <defs>
                    <linearGradient id="paint0_linear_2_111" x1="-0.00177145" y1="142" x2="224.138" y2="142" gradientUnits="userSpaceOnUse">
                    <stop offset="0.000558651" stop-color="#00599D"/>
                    <stop offset="0.5397" stop-color="#58B5E0"/>
                    <stop offset="1" stop-color="#0085A0"/>
                    </linearGradient>
                    <linearGradient id="paint1_linear_2_111" x1="139.614" y1="177.411" x2="177.233" y2="177.411" gradientUnits="userSpaceOnUse">
                    <stop offset="0.000558651" stop-color="#00599D"/>
                    <stop offset="0.5397" stop-color="#58B5E0"/>
                    <stop offset="1" stop-color="#0085A0"/>
                    </linearGradient>
                    </defs>
                </svg>

            </div>

            <div class="measurement-solution__content">
                <p class="measurement-solution__title"><span class="measurement-solution__title--strong">Calidad</span> del agua</p>
                <p class="measurement-solution__description">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, morbi quis tempor odio.
                </p>
            </div>

            <div class="measurement-solution__mask"></div>
            <div class="measurement-solution__mask--hover"></div>
        </div>
</section>

<section id="form">
    <?php
        $response = session()->get('response');
if(isset($response)):
    ?>
        <script type="module">
            Swal.fire({
                title: "<?= $response['title']; ?>",
                text: "<?= $response['message']; ?>",
                icon: "<?= $response['type']; ?>",
                confirmButtonColor: '#0174F6'
            })
        </script>
    <?php endif; ?>

    <form class="container-sm form" action="/email/contacto" method="POST">
        <div class="form__icon">
            <svg xmlns="http://www.w3.org/2000/svg" height="60" fill="#ffffff" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"/>
            </svg>
        </div>

        <legend class="form__legend">Contáctanos</legend>

        <div class="form__field">
            <label for="product-name" class="form__label">Nombre del Producto</label>
            <?= isset($errors['product-name']) ? '<p class="form__error">' . $errors['product-name'] . '</p>' : '' ?>
            <input id="product-name" name="product-name" type="text" class="form__input" value="<?= old('product-name')?>" placeholder="Ingrese el nombre del producto">
        </div>

        <div class="form__field">
            <label for="inquirer-name" class="form__label">Nombre del Solicitante</label>
            <?= isset($errors['inquirer-name']) ? '<p class="form__error">' . $errors['inquirer-name'] . '</p>' : '' ?>
            <input id="inquirer-name" name="inquirer-name" type="text" class="form__input" value="<?= old('inquirer-name')?>" placeholder="Ingrese su nombre">
        </div>

        <div class="form__field">
            <label for="inquirer-email" class="form__label">E-Mail</label>
            <?= isset($errors['inquirer-email']) ? '<p class="form__error">' . $errors['inquirer-email'] . '</p>' : '' ?>
            <input id="inquirer-email" name="inquirer-email" type="email" class="form__input" value="<?= old('inquirer-email')?>" placeholder="Ingrese su correo">
        </div>

        <div class="form__field">
            <label for="message" class="form__label">Mensaje</label>
            <?= isset($errors['message']) ? '<p class="form__error">' . $errors['message'] . '</p>' : '' ?>
            <textarea id="message" name="message" rows="5" class="form__textarea" placeholder="Ingrese su mensaje"><?= old('message')?></textarea>
        </div>

        <input class="form__submit" type="submit" value="Enviar">
    </form>
</section>
<?php $this->endSection('content'); ?>