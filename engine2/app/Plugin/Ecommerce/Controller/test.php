<ul class="slides index-slide">
    <li data-ng-repeat="(ind,val) in gallery" data-ng-if="$index == 0 ">
        <input type="radio" name="radio-btn" id="img-{{$index + 1}}" checked/>

        <div class="slide-container">
            <div class="slide">
                <img data-ng-src="{{galleryImages}}{{val.Gallery.id}}.{{val.Gallery.image_extension}}"
                     alt=" {{val.Gallery.title}}">

                <div class="slide-info">
                    <h3>{{val.Gallery.title}}</h3>

                    <p data-ng-bind-html="shortDescription(val.Gallery.details,100)">

                    </p>
                </div>
            </div>
            <div class="nav">
                <label for="img-{{totalGallery}}" class="prev">&#x2039;</label>
                <label for="img-{{$index + 2}}" class="next">&#x203a;</label>
            </div>
        </div>
    </li>
    <li data-ng-repeat="(ind,val) in gallery"
        data-ng-if="$index != 0 && $index != totalGallery -1">
        <input type="radio" name="radio-btn" id="img-{{$index + 1}}" checked/>

        <div class="slide-container">
            <div class="slide">
                <img data-ng-src="{{galleryImages}}{{val.Gallery.id}}.{{val.Gallery.image_extension}}"
                     alt=" {{val.Gallery.title}}">

                <div class="slide-info">
                    <h3>{{val.Gallery.title}}</h3>

                    <p data-ng-bind-html="shortDescription(val.Gallery.details,100)">
                    </p>
                </div>
            </div>
            <div class="nav">
                <label for="img-{{$index}}" class="prev">&#x2039;</label>
                <label for="img-{{$index + 2}}" class="next">&#x203a;</label>
            </div>
        </div>
    </li>
    <li data-ng-repeat="(ind,val) in gallery" data-ng-if="$index == totalGallery - 1 ">
        <input type="radio" name="radio-btn" id="img-{{totalGallery}}" checked/>

        <div class="slide-container">
            <div class="slide">
                <img data-ng-src="{{galleryImages}}{{val.Gallery.id}}.{{val.Gallery.image_extension}}"
                     alt=" {{val.Gallery.title}}">

                <div class="slide-info">
                    <h3>{{val.Gallery.title}}</h3>

                    <p data-ng-bind-html="shortDescription(val.Gallery.details,100)">

                    </p>
                </div>
            </div>
            <div class="nav">
                <label for="img-{{totalGallery - 1}}" class="prev">&#x2039;</label>
                <label for="img-{{totalGallery - $index }}" class="next">&#x203a;</label>
            </div>
        </div>
    </li>

    <li class="nav-dots">
        <label data-ng-repeat="(ind,val) in gallery" for="img-{{$index +1}}" class="nav-dot"
               id="img-dot-{{$index +1}}"></label>

    </li>
</ul>