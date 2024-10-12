@extends('layouts.main')

@section('container')
    <section>
        <header>
            <h2 class="text-center text-2xl font-bold text-gray-900 sm:text-3xl">Meet TicTic.ID Team 😍🎉</h2>
        </header>

        <div class="container mx-auto max-w-2xl">
            <div class="text-lg mt-3 text-justify leading-relaxed">
                The development background of the TicTic platform began with the challenges faced in managing concert
                events, which drove us to develop an innovative ticket management system. From conventional ticket sales to
                inefficient on-site ticket checking, we realized that these issues not only disrupt event organizers but
                also diminish the experience for attendees. This becomes increasingly critical as people demand quality
                service and comfort at the events they attend. Additionally, the importance of comprehensive information
                about music events is becoming more apparent, covering details such as parking facilities, sanitation, Food
                and Beverage stands, and additional services like Lost and Found. On the other hand, event organizers are
                under pressure to maximize profitability while limiting available resources. Understanding these challenges,
                we recognized that the solution needed not only to improve ticket management but also to optimize the
                functions of event organizers. </div>

            <div class="lg:grid grid-cols-2 lg:gap-4 p-4 space-y-3 lg:space-y-0">
                <div class="col-span-1">
                    <div class="flex flex-col justify-center items-center gap-2">
                        <img src="https://play-lh.googleusercontent.com/GonZpvea5HJx2osWt6yaYEGcrM7NedMciAzpwGHAA3CA_ahdYjTsw5Yk2k0gcoabWdc=w750-h750"
                            class="ease-in duration-150 rounded-lg hover:shadow-xl" alt="I Dewa Gede Mahadi Saputra" />
                        <span class="font-bold">I Dewa Gede Mahadi Saputra</span>
                    </div>
                </div>

                <div class="col-span-1">
                    <div class="flex flex-col justify-center items-center gap-2">
                        <img src="https://cdn.imgchest.com/files/pyq9c5m8mo4.png"
                            class="ease-in duration-150 rounded-lg hover:shadow-xl" alt="I Made Jaya Agastya" />
                        <span class="font-bold">I Made Jaya Agastya</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
