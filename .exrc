" HTML
let g:emmet_html5 = 0

" PHP
augroup php
  autocmd!
  autocmd FileType php setlocal shiftwidth=4
augroup END

" Symfony
set wildignore+=*/var/*,*/vendor/*
