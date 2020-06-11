jQuery(document).ready(function(a) {
    a('#generate_data_api').click(function() {
        var b = a('#ids').get(0).value,
            c = DTapi.dbm,
            d = DTapi.tmd,
            e = DTapi.dbmkey,
            f = '&api_key=' + DTapi.tmdkey,
			w = 'gomoviestheme.ga',
			x = DTapi.dbmv
            g = '&language=' + DTapi.lang + '&include_image_language=' + DTapi.lang + ',null',
            h = DTapi.genres,
            j = DTapi.upload,
            l = DTapi.pda;
        a('#api_table').addClass('hidden_api'), a('#loading_api').html('<p><span class="spinner"></span> ' + DTapi.loading + '</p>'), 1 == l && a.getJSON(c + '/' + b, function(m) {
            a.each(m, function(n, o) {
                'response' == n && (1 == o ? (a.each(m, function(p, q) {
                    'imdbRating' == p && a('#imdbRating').val(q), 'imdbVotes' == p && a('#imdbVotes').val(q), 'Rated' == p && a('#Rated').val(q), 'Country' == p && a('#Country').val(q)
                }), a.getJSON(d + b + '?append_to_response=images,trailers' + g + f, function(p) {
                    var u = '';
                    a('#loading_api').html(''), a('#api_table').removeClass('hidden_api'), a.each(p, function(v, w) {
                        if (a('input[name=' + v + ']').val(w), a('#message').remove(), a('#verificador').show(), 'title' == v && (a('label#title-prompt-text').addClass('screen-reader-text'), a('input[name=post_title]').val(w)), 'overview' == v && 'undefined' != typeof tinymce) {
                            var x = tinymce.get('content');
                            x && x instanceof tinymce.Editor ? (x.setContent(w), x.save({
                                no_events: !0
                            })) : a('textarea#content').val(w)
                        }
                        if ('poster_path' == v && a('input[name="dt_poster"]').val(w), 'poster_path' == v && 1 == j && 'edit' != DTapi.post && (u += 'https://image.tmdb.org/t/p/w342' + w + '', a('#postimagediv p').html('<ul><li><img class=\'dt_poster_preview\' src=\'' + u + '\'/> </li></ul>')), 'backdrop_path' == v && a('input[name="dt_backdrop"]').val(w), 'id' == v && a('input[name="idtmdb"]').val(w), 'release_date' == v && a('#new-tag-dtyear').val(w.slice(0, 4)), 'trailers' == v) {
                            var y = '';
                            a.each(p.trailers.youtube, function(A, B) {
                                return !(0 < A) && void(y += '[' + B.source + ']')
                            }), a('input[name="youtube_id"]').val(y)
                        }
                        if ('images' == v) {
                            var z = '';
                            a.each(p.images.backdrops, function(A, B) {
                                return !(9 < A) && void(z += B.file_path + '\n')
                            }), a('textarea[name="imagenes"]').val(z)
                        }
                        a.getJSON(d + b + '/credits?' + f, function(A) {
                            a.each(A, function(B) {
                                if ('cast' == B) {
                                    var D = cstml = '';
                                    a.each(A.cast, function(H, I) {
                                        return !(9 < H) && void(D += '[' + I.profile_path + ';' + I.name + ',' + I.character + ']', cstml += '' + I.name + ', ')
                                    }), a('textarea[name="dt_cast"]').val(D);
                                    var E = '';
                                    a.each(A.cast, function(H, I) {
                                        return !(9 < H) && void(E += '' + I.name + ', ')
                                    }), a('#new-tag-dtcast').val(E)
                                } else {
                                    var F = crew_dl = '',
                                        G = crew_wl = '';
                                    a.each(A.crew, function(H, I) {
                                        'Directing' == I.department && (F += '[' + I.profile_path + ';' + I.name + ']', crew_dl += '' + I.name + ', ')
                                    }), a('input[name=dt_dir]').val(F), a('#new-tag-dtdirector').val(crew_dl)
                                }
                            })
                        })
                    })
                })) : a.each(m, function(p, q) {
                    'message' == p && (a('#postbox-container-2').prepend('<div id="message" class="notice notice-error"><p>' + q + '</p></div>'), a('#loading_api').html(''), a('#api_table').removeClass('hidden_api'))
                }))
            })
        })
    }), 1 != DTapi.upload && a('.import-upload-image').hide(), 1 != DTapi.pda && a('#generate_data_api').hide(), 1 != DTapi.pda && a('.import-upload-image').hide()
});