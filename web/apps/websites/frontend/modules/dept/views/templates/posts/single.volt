{{ partial('breadcrumb') }}
<section class="main-container">
    <div class="container">
        <div class="row">
            <div class="main col-lg-9">
                <article class="blogpost full">
                    <header>
                        <h3>{{title}}</h3>
                        <div class="post-info">
                            <span class="post-date">
                                <i class="fa fa-calendar-o pr-1"></i>
                                <span class="day">{{helper.getWVN(items.calendar)}}, {{ ml._ml('day', 'ngày') }} {{ helper.datetimeVn(items.calendar) }}</span>
                            </span>
                        </div>
                    </header>
                    <div class="blogpost-content">
                        {% if items.image %}
                        <div class="w-100">
                            <div class="overlay-container d-flex justify-content-center">
                                <img src="{{ helper.getLinkImage(items.image) }}" alt="{{title}}">
                            </div>
                        </div>
                        {% endif %}
                        <hr>
                        <div class="mt-2">
                            {{itemslang.content}}
                        </div>
                    </div>
                </article>
            </div>
            <aside class="col-lg-3 col-xl-3 ml-xl-auto">
                {{ partial('sidebar') }}
            </aside>
        </div>
    </div>
</section>