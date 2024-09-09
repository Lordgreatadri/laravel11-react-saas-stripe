import AuthenticatedLayout from '../Layouts/AuthenticatedLayout';
import { Link, usePage } from '@inertiajs/react';
import {P} from '../../../public/build/assets/PrimaryButton-BdrLT4W_';

export default function Feature({feature, answer, children}) {
    const {auth} = usePage().props;
    const availableCredtis = auth.user.available_credits;
    return (
        <AuthenticatedLayout 
            user = {auth.user}
            header ={
                <h2 className="font-semibold text-xl text-gray-800 dark:-text-gray-200 leading-tight">{feature.name}</h2>

            }
        >
            <Head title = "Feature 1" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    {answer !== null &&(
                        <div className="mb-3 py-3 px-5 rounded text-white bg-emerald-600 text-xl ">
                            Result of caluclation : {answer}
                        </div>
                    )}
                    <div classNmae="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg relative" >
                        {availableCredtis !== null && feature.required_credits > availableCredtis (
                            <div className="absolute left-0 top-0 right-o bottm-0 z-20 flex flex-col items-center justify-center bg-white/70 gap-3 ">
                                Credits remaining : {availableCredtis}
                                {/* <svg 
                                    xmlns="http://www.w3.org/2000/svg" fill="none" stroke-width="1.5" stroke="currentColor"
                                    className="w-12 h-12">
                                        <path d="M10.29 2.29L2.29 10.29C1.9 10.68 1.9 11.32 2.29 11.71L11.71 2.29C12.09 1.9 12.63 1.9 13 2.29C13.38 2.68 13.38 3.32 13 3.71L2.71 13C2.32 13.38 1.9 13.92 1.9 14.31C1.9 14.7 2.32 15.13 2.71 15.42L15"></path>
                                </svg> */}

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                </svg>
                                <div>
                                    You do not have enough credit to use the feature. Go {""}
                                    
                                    <Link href={route("credit.index")}>
                                        <a className="font-semibold  text-indigo-500 hover:text-indigo-400 hover:underline">buy credits</a>
                                    </Link>
                                </div>
                            </div>
                        )}
                        <div className='p-8 text-gray-400 borfer-b pb-4'>
                            <p>{feature.description}</p>
                            <p className='text-sm italic text-right'> Requires {feature.required_credits} credits</p>
                        </div>
                        {children}
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    )
}