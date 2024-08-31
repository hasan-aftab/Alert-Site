<style>
    .star {
    width: 32px;
    height: 32px;
    transition: .6s all;
  }
  #rating {
    cursor: pointer;
    display: inline-block
  }
  #review-form .input-group-addon {
    min-width: 100px;
  }
  #review-form .btn {
    min-width: 100px;
  }
  #review-form input[type="text"],
  #review-form textarea {
    width: 100%;
  }
  #review-form .form-group {
    margin-bottom: 15px;
  }
  #review-form .help-block {
    display: block;
    margin-top: 5px;
    margin-bottom: 10px;
  }
  
  blockquote {
    border-left: 5px solid rgb(238, 238, 238);
    padding-left: 20px;
  }
  
  blockquote .footer{
    display: block;
    font-size: 80%;
  }

  .stars-container {
    margin-bottom: 5px;
  }
</style>

<div class="container">
<form id="review-form" action="{{route('save_review')}}" method="post">
  @csrf
  <h3>Write Your Review</h3>
  <div id="rating">
    <svg class="star" id="1" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" style="fill: #f39c12;">
      <polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566"></polygon>
    </svg>
    <svg class="star" id="2" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" style="fill: #f39c12;">
      <polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566"></polygon>
    </svg>
    <svg class="star" id="3" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" style="fill: #f39c12;">
      <polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566"></polygon>
    </svg>
    <svg class="star" id="4" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" style="fill: #f39c12;">
      <polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566"></polygon>
    </svg>
    <svg class="star" id="5" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" style="fill: #808080;">
      <polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566"></polygon>
    </svg>
  </div>
  <br/><br/>
  <div class="form-group">
    <label class="control-label" for="review">Your Review:</label>
    <textarea class="form-control" rows="10" placeholder="Your Reivew" name="review" id="review"></textarea>
    <span id="reviewInfo" class="help-block pull-right">
      <span id="remaining">999</span> Characters remaining
    </span>
  </div>
  <h2>Your Info:</h2>

  @auth
    Name: {{ auth()->user()->name }}
    Email: {{ auth()->user()->email }}
@else
    User is not logged in
@endauth

  @auth
    <div class="form-group">
      <label for="name">Name:</label>
      <input class="form-control" type="text" placeholder="Name" name="name" id="name" value="{{ auth()->user()->name }}">
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input class="form-control" type="text" placeholder="Email" name="email" id="email" value="{{ auth()->user()->email }}">
    </div>
  @else
    <div class="form-group">
      <label for="name">Name:</label>
      <input class="form-control" type="text" placeholder="Name" name="name" id="name" value="">
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input class="form-control" type="text" placeholder="Email" name="email" id="email" value="">
    </div>
  @endauth

  <input type="hidden" value="" id="stars" name="stars">
  <input type="hidden" value="{{$blog->id}}" id="blog_id" name="blog_id">

  <a href="#" id="submit" class="btn btn-primary">Submit</a>
  <input id="submitForm" type="submit" style="display:none;">
</form>
<br><br>
@if($reviews->count())
  <h2>Read what others have said about us:</h2>
@endif
<div id="review-container">
</div>
</div>
<script>
    function starsReducer(state, action) {
    switch (action.type) {
      case 'HOVER_STAR': {
        return {
          starsHover: action.value,
          starsSet: state.starsSet
        }
      }
      case 'CLICK_STAR': {
        return {
          starsHover: state.starsHover,
          starsSet: action.value
        }
      }
        break;
      default:
        return state
    }
  }

  var StarContainer = document.getElementById('rating');
  var StarComponents = StarContainer.children;

  var state = {
    starsHover: 0,
    starsSet: 4
  }

  function render(value) {
    for(var i = 0; i < StarComponents.length; i++) {
      StarComponents[i].style.fill = i < value ? '#f39c12' : '#808080'
    }
  }

  for (var i=0; i < StarComponents.length; i++) {
    StarComponents[i].addEventListener('mouseenter', function() {
      state = starsReducer(state, {
        type: 'HOVER_STAR',
        value: this.id
      })
      render(state.starsHover);
    })

    StarComponents[i].addEventListener('click', function() {
      state = starsReducer(state, {
        type: 'CLICK_STAR',
        value: this.id
      })
      render(state.starsHover);
    })
  }

  StarContainer.addEventListener('mouseleave', function() {
    render(state.starsSet);
  })

  var review = document.getElementById('review');
  var remaining = document.getElementById('remaining');
  review.addEventListener('input', function(e) {
    review.value = (e.target.value.slice(0,999));
    remaining.innerHTML = (999-e.target.value.length);
  })

  var form = document.getElementById("review-form")

  form.addEventListener('submit', function(e) {
  // Prevent the default form submission behavior
  e.preventDefault();

  // Retrieve form values
  let reviewValue = form['review'].value.trim();
  let nameValue = form['name'].value.trim();
  let emailValue = form['email'].value.trim();
  console.log(state)  

  // Check if all fields have values
  if (reviewValue && nameValue && emailValue) {
    // Allow default form submission behavior
    let starsInput = document.getElementById('stars');
    starsInput.value = state.starsSet;
    form.submit();
  } else {
    // Log the data if fields are not filled
    let post = {
      stars: state.starsSet,
      review: reviewValue,
      name: nameValue,
      email: emailValue
    }
    console.log(post);
  }
});


  document.getElementById('submit').addEventListener('click', function(e) {
    e.preventDefault();
    document.getElementById('submitForm').click();
  })

  var reviews = {
      reviews: @json($reviews->toArray())
  };
  console.log('reviewing', reviews);

  function ReviewStarContainer(stars) {
    var div = document.createElement('div');
    div.className = "stars-container";
    for (var i = 0; i < 5; i++) {
      var svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
      svg.setAttribute('viewBox',"0 12.705 512 486.59");
      svg.setAttribute('x',"0px");
      svg.setAttribute('y',"0px");
      svg.setAttribute('xml:space',"preserve");
      svg.setAttribute('class',"star");
      var svgNS = svg.namespaceURI;
      var star = document.createElementNS(svgNS,'polygon');
      star.setAttribute('points', '256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566');
      star.setAttribute('fill', i < stars ? '#f39c12' : '#808080');
      svg.appendChild(star);
      div.appendChild(svg);
    }
    return div;
  }

  function ReviewContentContainer(name, city, review) {

    var reviewee = document.createElement('div');
    reviewee.className = "reviewee footer";
    reviewee.innerHTML  = '- ' + name

    var comment = document.createElement('p');
    comment.innerHTML = review;

    var div = document.createElement('div');
    div.className = "review-content";
    div.appendChild(comment);
    div.appendChild(reviewee);

    return div;
  }

  function ReviewsContainer(review) {
    var div = document.createElement('blockquote');
    div.className = "review";
    div.appendChild(ReviewStarContainer(review.rate));
    div.appendChild(ReviewContentContainer(review.name,review.city,review.review));
    return div;
  }

  setTimeout(() => {
    for(var i = 0; i < reviews.reviews.length; i++) {
      document.getElementById('review-container').appendChild(ReviewsContainer(reviews.reviews[i]))
    }
  }, 1000);
</script>