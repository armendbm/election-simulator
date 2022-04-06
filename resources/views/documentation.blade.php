<x-app-layout>
    <br>
    <h2>
        {{ __('Documentation') }}
    </h2>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p>Total users Result Handler: {{ $resultHandler -> getVoteTotal() }} </p>
                    <h4 class="mt-3">Overview</h4>
                    <p>
                        Civics is a complex topic fundamental to performing our duties as a member of our society. Learning about voting systems can be exhaustive, and people often do not have the time to simulate elections on their own. Since elections are often taught through hypotheticals and lectures, we seek to create a hands-on tool that allows users to manipulate, test, and better understand different systems of elections.
                    </p>
                    <p>
                        There is no educational tool on the market which allows you to visually compare how different voting systems work, nor is there an effective tool to demonstrate how different  systems, like the Electoral College, works. For the remainder of this report, we will provide an overview of the development process, schedule, risks, features, and a business case to showcase the value of our product.
                    </p>
                    <h4 class="mt-3">FPTP</h4>
                    <p>

                    </p>
                    <h4 class="mt-3">IRV</h4>
                    <p>

                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
