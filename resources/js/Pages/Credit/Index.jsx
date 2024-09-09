import Authenticated from "../../Layouts/AuthenticatedLayout";
import CoinImage from '@/Components/CoinImage';
import PackagesPricingCard from '@/Components/PackagesPricingCard';
import { Head } from "@inertiajs/react";

export default function Index({auth, packages, features, success, error}) {
    const availableCredits = auth. user.available_credits;
    return (
        <Authenticated
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 darK:text-gray-200 leadning-tight">Your Credits</h2>}
        >
            <Head title="Your Credits" />
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    {success && <div className="py-4 px-4 bg-green-500 text-white text-xl rounded-md">{success}</div>}
                    {error && <div className="py-4 px-4 bg-red-500 text-white text-xl">{error}</div>}
                    <div className="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg relative">
                        <div className="flex flex-col gap-3 items-center p-4">
                            {/* <CoinImage className="w-[100px]"/> */}
                            <img src="/img/coin-removebg.png" className="w-[100px]"/>
                            <h3 className="text-2xl font-bold text-white dark:text-gray-200">You have {availableCredits} credits.</h3>
                        </div>
                        <PackagesPricingCard packages={packages.data} features={features.data}/>
                    </div>

                </div>
            </div>

   
        </Authenticated>
    );
}