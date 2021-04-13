" HTML
let g:emmet_html5 = 0

" CSS
augroup css
  autocmd!
  autocmd FileType css setlocal shiftwidth=4
augroup END

" PHP
augroup php
  autocmd!
  autocmd FileType php setlocal shiftwidth=4
augroup END

" Javascript
augroup javascript
  autocmd!
  autocmd FileType javascript setlocal shiftwidth=4
augroup END

" Symfony
set wildignore+=*/var/*,*/vendor/*,*/public/build/*
