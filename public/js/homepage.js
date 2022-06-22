/* Sezione fetch e update posts */
function onResponse(response) {
    return response.json();
}

function fetch_Posts_update(){
    fetch(BASE_URL + 'homepage/allPosts').then(onResponse).then(updatePosts);
}

function updatePosts(json) {
    const posts_section = document.querySelector('main .post_section');
    posts_section.innerHTML = '';
    for(let rec of json.recipes) {
        const post_div = document.createElement('div');
        post_div.classList.add('post_div');
        post_div.dataset.post_id = rec.id;

        const div_username = document.createElement('div');
        div_username.classList.add('div_username');
        div_username.textContent = '@'+rec.username;
        post_div.appendChild(div_username);

        const div_date = document.createElement('div');
        div_date.classList.add('div_date');
        div_date.textContent = String(rec.created_at).split('T',1);
        post_div.appendChild(div_date);

        const rec_title = document.createElement('span');
        rec_title.classList.add('rec_title');
        rec_title.textContent = rec.title;
        post_div.appendChild(rec_title);

        const ingr_list = document.createElement('div');
        ingr_list.classList.add('ingr_list');
        let count = 0;
        for(let ingr of json.ingredients) {
            if(ingr.recipe_id === rec.id) {
                const single_ingr = document.createElement('div');
                single_ingr.textContent = ingr.name;
                ingr_list.appendChild(single_ingr);
                count++;
            }
        }
        if(count === 0) {
            const single_ingr = document.createElement('div');
            single_ingr.textContent = 'No ingredients found';
            ingr_list.appendChild(single_ingr);
        }
        post_div.appendChild(ingr_list);

        const descr = document.createElement('p');
        descr.classList.add('descr');
        descr.textContent = rec.text;
        post_div.appendChild(descr);

        const image = document.createElement('img');
        if(rec.image == null || rec.image.length == 0) {
            image.src = './images/post_image_default.jpg';
        } else {
            image.src = rec.image;
        }     
        post_div.appendChild(image);


        const nlike_ncomment = document.createElement('div');
        nlike_ncomment.classList.add('nlike_ncomment');

        const nlikes = document.createElement('div');
        nlikes.classList.add('nlikes');
        const img_like = document.createElement('img');
        img_like.classList.add('like_dislike');

        img_like.dataset.like_post = rec.user_likes;
        if(rec.user_likes == 'true') {
            img_like.src = './images/like.png';
        }
        else {
            img_like.src = './images/dislike.png';
            img_like.addEventListener('mouseover',like_mouse);
            img_like.addEventListener('mouseleave',dislike_mouse);
        }
        img_like.addEventListener('click',set_unset_like);

        nlikes.appendChild(img_like);
        const span_like = document.createElement('span');
        span_like.textContent = rec.nlikes;
        nlikes.appendChild(span_like);
        nlike_ncomment.appendChild(nlikes);


        const favorite = document.createElement('div');
        favorite.classList.add('favorite');
        const img_fav = document.createElement('img');
        img_fav.classList.add('fav_notfav');
        
        img_fav.dataset.fav_post = rec.user_fav;
        if(rec.user_fav == 'true') {
            img_fav.src = './images/favorite.png';
        }
        else {
            img_fav.src = './images/not_favorite.png';
            img_fav.addEventListener('mouseover',fav_mouse);
            img_fav.addEventListener('mouseleave',not_fav_mouse);
        }
        img_fav.addEventListener('click', set_unset_fav);

        favorite.appendChild(img_fav);
        nlike_ncomment.appendChild(favorite);

        const ncomments = document.createElement('div');
        ncomments.classList.add('ncomments');
        const img_comm = document.createElement('img');
        img_comm.classList.add('enable_read_comment');
        img_comm.src = './images/disable_comment.png';
        img_comm.addEventListener('click',enable_disable_comments);
        img_comm.addEventListener('mouseover',enable_comment_mouse);
        img_comm.addEventListener('mouseleave',disable_comment_mouse);
        img_comm.dataset.enable_comm = 'false';

        ncomments.appendChild(img_comm);
        const span_comm = document.createElement('span');
        span_comm.textContent = rec.ncomments;
        ncomments.appendChild(span_comm);
        nlike_ncomment.appendChild(ncomments);
        post_div.appendChild(nlike_ncomment);


        /* PER MOBILE */
        const sec_comm = document.createElement('section');
        sec_comm.classList.add('comment_of_post');

        post_div.appendChild(sec_comm);
        /*  */

        posts_section.appendChild(post_div);
    }  
    if(posts_section.innerHTML == '') {
        const h2 = document.createElement('h2');
        h2.textContent = 'Nessuna ricetta da visualizzare';
        h2.classList.add('error');
        posts_section.appendChild(h2);
        const backhome = document.createElement('a');
        backhome.id = 'backHome';
        backhome.href = "homepage";
        backhome.textContent = 'Torna alla Home';
        posts_section.appendChild(backhome);
    }
}
//All'avvio
fetch_Posts_update();

/* Sezione cerca post per ingrediente */
function fetch_post_by_ingredient(event) {
    event.preventDefault();

    let form_to_use = null;
    if(window.innerWidth <= 600) {
        form_to_use = form_search_ingr_mobile;
    } else {
        form_to_use = form_search_ingr;
    }

    fetch(BASE_URL + 'homepage/ingredient/' + encodeURIComponent(form_to_use.ingredient.value)).then(onResponse).then(updatePosts);
    form_to_use.ingredient.value = '';
}
const form_search_ingr = document.forms['search_by_ingredient'];
form_search_ingr.addEventListener('submit',fetch_post_by_ingredient);

/* PER MOBILE */
const form_search_ingr_mobile = document.forms['search_by_ingredient_mobile'];
form_search_ingr_mobile.addEventListener('submit',fetch_post_by_ingredient);


/* Sezione User Info */
function fetch_userInfo(){
    fetch(BASE_URL + 'homepage/getUserInfo').then(onResponse).then(updateUserInfo);
}
function updateUserInfo(json){
    const stat = document.getElementById('statistics');
    stat.querySelector('.like .number').textContent = json.N_likes;
    stat.querySelector('.fav .number').textContent = json.N_fav;
    stat.querySelector('.comment .number').textContent = json.N_comm;
}
//All'avvio
fetch_userInfo();

function update_pro_gif(json) {
    if(json.pro_gif !== null)
        document.querySelector('.profile_info .profile_img img').src = json.pro_gif;
}
fetch(BASE_URL + 'homepage/getProGif').then(onResponse).then(update_pro_gif);



/* Sezione like */
function updateNumLikes(json){
    const allPosts = document.querySelectorAll('.post_section .post_div');
    for(let post of allPosts) {
        if(post.dataset.post_id === json.post_id) {
            post.querySelector('.nlikes span').textContent = json.quantity;
            break;
        }
    }
}

function set_unset_like(event) {
    image = event.currentTarget;
    const post_div = image.parentNode.parentNode.parentNode;
    const span_nlike = image.parentNode.querySelector('span');

    if(image.dataset.like_post === 'false') {
        /* Mette il like */
        image.removeEventListener('mouseleave',dislike_mouse);
        image.removeEventListener('mouseover',like_mouse);
        image.dataset.like_post = 'true';
        image.src = './images/like.png';

        fetch(BASE_URL + 'homepage/like/set/'+post_div.dataset.post_id).then(onResponse).then(updateNumLikes);

    } else if(image.dataset.like_post === 'true') {
        /* Toglie il like */
        image.addEventListener('mouseover',like_mouse);
        image.addEventListener('mouseleave',dislike_mouse);
        image.dataset.like_post = 'false';
        image.src = './images/dislike.png';

        fetch(BASE_URL + 'homepage/like/unset/'+post_div.dataset.post_id).then(onResponse).then(updateNumLikes);
    
    }

    fetch_userInfo();
}

function like_mouse(event) {
    event.currentTarget.src = './images/like.png';
}
function dislike_mouse(event) {
    event.currentTarget.src = './images/dislike.png';
}

/* Sezione preferiti */
function set_unset_fav(event) {
    image = event.currentTarget;
    const post_div = image.parentNode.parentNode.parentNode;

    if(image.dataset.fav_post === 'false') {
        /* Mette il favorite */
        image.removeEventListener('mouseleave',not_fav_mouse);
        image.removeEventListener('mouseover',fav_mouse);
        image.dataset.fav_post = 'true';
        image.src = './images/favorite.png';

        fetch(BASE_URL + 'homepage/favorite/set/'+post_div.dataset.post_id);

    } else if(image.dataset.fav_post === 'true') {
        /* Toglie il favorite */
        image.addEventListener('mouseover',fav_mouse);
        image.addEventListener('mouseleave',not_fav_mouse);
        image.dataset.fav_post = 'false';
        image.src = './images/not_favorite.png';

        fetch(BASE_URL + 'homepage/favorite/unset/'+post_div.dataset.post_id);
    
    }

    fetch_userInfo();
}

function fav_mouse(event) {
    event.currentTarget.src = './images/favorite.png';
}
function not_fav_mouse(event) {
    event.currentTarget.src = './images/not_favorite.png';
}



/* Sezione comment */
function updateNumComments(json){
    const allPosts = document.querySelectorAll('.post_section .post_div');
    for(let post of allPosts) {
        if(post.dataset.post_id === json.recipe_id) {
            post.querySelector('.ncomments span').textContent = json.quantity;
            break;
        }
    }
}

function delete_comment(event) {
    const single_comm = event.currentTarget.parentNode.parentNode;
    const comment_id = single_comm.dataset.comm_id;
    const recipe_id = single_comm.parentNode.dataset.post_id;
    fetch(BASE_URL + 'homepage/delete_comment/'+comment_id+'/'+recipe_id ).then(onResponse).then(updateNumComments);

    fetch(BASE_URL + 'homepage/allComments/'+single_comm.parentNode.dataset.post_id).then(onResponse).then(display_comments);

    fetch_userInfo();
}

function display_comments(json){
    const pub_comm = document.getElementById('published_comments');
    pub_comm.innerHTML = '';

    for(let comm of json.comments) {
        const single_comm = document.createElement('div');
        single_comm.classList.add('single_comment');
        single_comm.dataset.comm_id = comm.id;

        const head = document.createElement('div');
        head.classList.add('head');
        const div_user = document.createElement('div');
        div_user.classList.add('div_username');
        div_user.textContent = '@'+comm.username;
        head.appendChild(div_user);
        if(comm.user_id === json.user_id) {
            const img_delete = document.createElement('img');
            img_delete.src = './images/delete_comment.png';
            img_delete.classList.add('delete');
            img_delete.addEventListener('click',delete_comment);
            head.appendChild(img_delete);
        }
        single_comm.appendChild(head);

        const p = document.createElement('p');
        p.classList.add('descr');
        p.textContent = comm.text;
        single_comm.appendChild(p);

        pub_comm.appendChild(single_comm);
    }

    pub_comm.parentNode.classList.remove('comments_disabled');

    /* PER MOBILE */
    if(window.innerWidth <= 600) {
        const div_comments = document.querySelector('div.div_comments').cloneNode(true);
        const images = div_comments.querySelectorAll('.single_comment img');
        for(let img of images) {
            img.addEventListener('click',delete_comment);
        }

        div_comments.querySelector('div').id = 'published_comments_clone';

        form_comm_clone = div_comments.querySelector('form');
        form_comm_clone.name = 'publish_comment_clone';
        form_comm_clone.addEventListener('submit',publish_comment);

        const posts = document.querySelectorAll('.post_section .post_div');
        for(let el of posts) {
            if(el.dataset.post_id == pub_comm.dataset.post_id) {
                el.querySelector('.comment_of_post').innerHTML = '';
                el.querySelector('.comment_of_post').appendChild(div_comments);
                break;
            }
        }
    }
    /*  */
}

function enable_disable_comments(event) {
    const image_comm = event.currentTarget;
    const post_div = image_comm.parentNode.parentNode.parentNode;
    document.getElementById('published_comments').dataset.post_id = post_div.dataset.post_id;

    /* PER MOBILE*/
    const posts = document.querySelectorAll('.post_section .post_div');
    for(let el of posts) {
        el.querySelector('.comment_of_post').innerHTML = '';
    }
    /*  */

    if(image_comm.dataset.enable_comm == 'false') {
        allImages_comm = document.querySelectorAll('.post_div .ncomments img');
        for(let img of allImages_comm) {
            img.src = './images/disable_comment.png';
            img.addEventListener('mouseover',enable_comment_mouse);
            img.addEventListener('mouseleave',disable_comment_mouse); 
            img.dataset.enable_comm = 'false';       
        }
        image_comm.removeEventListener('mouseover',enable_comment_mouse);
        image_comm.removeEventListener('mouseleave',disable_comment_mouse);
        image_comm.src = './images/enable_comment.png'; 
        image_comm.dataset.enable_comm = 'true';

        form_comm.textarea.disabled = false;
        form_comm.submit.disabled = false;

        fetch(BASE_URL + 'homepage/allComments/'+post_div.dataset.post_id).then(onResponse).then(display_comments);
    } else {
        image_comm.src = './images/disable_comment.png';
        document.getElementById('published_comments').innerHTML = '';
        document.querySelector('.div_comments').classList.add('comments_disabled');
        image_comm.dataset.enable_comm = 'false';
        image_comm.addEventListener('mouseover',enable_comment_mouse);
        image_comm.addEventListener('mouseleave',disable_comment_mouse);

        form_comm.textarea.disabled = true;
        form_comm.submit.disabled = true;
    }
}


function enable_comment_mouse(event) {
    event.currentTarget.src = './images/enable_comment.png';
}
function disable_comment_mouse(event) {
    event.currentTarget.src = './images/disable_comment.png';
}

function publish_comment(event) {
    event.preventDefault();

    const rec_id = document.getElementById('published_comments').dataset.post_id;

    let form_to_use = null;
    if(window.innerWidth <= 600) {
        form_to_use = form_comm_clone;
    } else {
        form_to_use = form_comm;
    }

    if(form_to_use.textarea.length !== 0) {
        const form_data = {
            method: 'post',
            body: new FormData(form_to_use)
        }
        fetch(BASE_URL + 'homepage/publish_comment/'+rec_id, form_data).then(onResponse).then(updateNumComments);

        fetch(BASE_URL + 'homepage/allComments/'+rec_id).then(onResponse).then(display_comments);
        
        form_to_use.textarea.value = '';
    }

    fetch_userInfo();
}

const form_comm = document.forms['publish_comment'];
form_comm.addEventListener('submit',publish_comment);

/* PER MOBILE */
let form_comm_clone = null;



/* Sezione go_up */
function go_up(event) {
    window.scroll({
        top: 0,
        behavior: "smooth"
    });
}
const div_go_up = document.querySelector('#go_up');
div_go_up.addEventListener('click', go_up);