<?php 
// Admin Portal
use App\Livewire\Admin\Admission\Applications\AllStudents;
use App\Livewire\Admin\InquiriesDetail\RegisteredDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\MetaWebhookController;
use App\Http\Controllers\WhatsAppWebhookController;

// Close database connections after every request - Fix for "Too many connections" error

use App\Http\Controllers\AuthController;
use App\Http\Livewire\Agent\ReportReminder;
use App\Livewire\Admin\AdmissionTeams;
use App\Livewire\Admin\InquiriesDetail;
use App\Livewire\Admin\InquiriesDetail\SelectCounsellor;
use App\Livewire\Admin\InquiriesDetail\SelectTeamInquiries;
use App\Livewire\Admin\ManageIPs;
use App\Livewire\Admin\Notifications;
use App\Livewire\Admin\Report\CounsellorReport;
use App\Livewire\Admin\Report\DailyTarget;
use App\Livewire\Admin\Report\Reports;
use App\Livewire\Admin\Report\TeamReports;
use App\Livewire\Admin\Settings\ManageIPs as AdminManageIPs;
use App\Livewire\Admin\InquiriesDetail\InquiriesDetail as AgentInquiry;
use App\Livewire\Admission\AdmissionForms\CaseClosedForm;
use App\Livewire\Admission\AdmissionForms\CasReceivedForm;
use App\Livewire\Admission\AdmissionForms\ConditionalOffersForm;
use App\Livewire\Admission\AdmissionForms\EnrollmentForm;
use App\Livewire\Admission\AdmissionForms\ProcessedForm;
use App\Livewire\Admission\AdmissionForms\UnconditionalOffersForm;
use App\Livewire\Admission\AdmissionForms\UnderCasForm;
use App\Livewire\Admission\AdmissionForms\VisaProcessForm;
use App\Livewire\Admission\AdmissionTeam\Dashboard;
use App\Livewire\Admission\Rejection;
use App\Livewire\Admission\Dashboard as AdmissionDashboard;
use App\Livewire\Admission\Reassign;
use App\Livewire\Admission\Withdrawn;
use App\Livewire\AdmissionAgent\Dashboard as AdmissionAgentDashboard;
use App\Livewire\Agent\AllReports;
use App\Livewire\Agent\DailyReport;
use App\Livewire\Agent\DailyReportReminder;
use App\Livewire\Agent\Inquiry\Registered as AgentRegistered;
use App\Livewire\Agent\Admission\AdmissionDashboard as AgentAdmissionDashboard;
use App\Livewire\ExternalAgent\Applications\AllApplications;
use App\Livewire\Manager\Admission\AdmissionDashboard as ManagerAdmissionDashboard;
use App\Livewire\Manager\Report\AddReport;
use App\Livewire\Manager\Report\AllReports as ManagerAllReports;
use App\Livewire\Manager\Report\DailyReportsReminder;
use App\Livewire\Manager\Inquiry\Registered as ManagerRegistered;
use App\Livewire\Manager\Report\TeamReport;
use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\Login;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Agent\Dashboard as AgentDashboard;
use App\Livewire\Manager\Dashboard as ManagerDashboard;
use App\Livewire\Admin\Userman\Users;
use App\Livewire\Admin\Teams;
use App\Livewire\Admin\Userman\Portallog;
use App\Livewire\Admin\Main\Inquiry as AdminInquiry;
use App\Livewire\Admin\Main\Hot as AdminHot;
use App\Livewire\Admin\Main\Cold as AdminCold;
use App\Livewire\Admin\Main\Dead as AdminDead;
use App\Livewire\Admin\Main\Pending as AdminPending;
use App\Livewire\Admin\Import;
use App\Livewire\Admin\Assign;
use App\Livewire\Admin\ReassignInquiry;
//Admin Admission
use App\Livewire\Admin\Admission\Applications\AllApplications as AdminAllApplications;
use App\Livewire\Admin\Admission\Applications\CaseClosed as AdminCaseClosed;
use App\Livewire\Admin\Admission\Applications\CasReceived as AdminCasReceived;
use App\Livewire\Admin\Admission\Applications\ConditionalOffers as AdminConditionalOffers;
use App\Livewire\Admin\Admission\Applications\Enrollment as AdminEnrollment;
use App\Livewire\Admin\Admission\Applications\Processed as AdminProcessed;
use App\Livewire\Admin\Admission\Applications\UnconditionalOffers as AdminUnconditionalOffers;
use App\Livewire\Admin\Admission\Applications\Underassessment as AdminUnderassessment;
use App\Livewire\Admin\Admission\Applications\UnderCas as AdminUnderCas;
use App\Livewire\Admin\Admission\Applications\VisaProcess as AdminVisaProcess;
use App\Livewire\Admin\Admission\Applications\Rejection as AdminRejection;
use App\Livewire\Admin\Admission\Applications\Withdrawn as AdminWithdrawn;




// Counsellor Portals
use App\Livewire\Agent\Inquiries as AgentInquiries;
use App\Livewire\Agent\NewInquiry as AgentNewInquiry;
use App\Livewire\Agent\Inquiry\Hot as AgentHot;
use App\Livewire\Agent\Inquiry\Cold as AgentCold;
use App\Livewire\Agent\Inquiry\Dead as AgentDead;
use App\Livewire\Agent\Inquiry\Pending as AgentPending;
use App\Livewire\Agent\Reminders as AgentReminders;
use App\Livewire\Agent\Admission\Underassessment as CounsellorUnderassessment;
use App\Livewire\Agent\Admission\Processed as CounsellorProcessed;
use App\Livewire\Agent\Admission\ConditionalOffers as CounsellorConditionalOffers;
use App\Livewire\Agent\Admission\UnconditionalOffers as CounsellorUnconditionalOffers;
use App\Livewire\Agent\Admission\UnderCas as CounsellorUnderCas;
use App\Livewire\Agent\Admission\CasReceived as CounsellorCasReceived;
use App\Livewire\Agent\Admission\VisaProcess as CounsellorVisaProcess;
use App\Livewire\Agent\Admission\Enrollment as CounsellorEnrollment;
use App\Livewire\Agent\Admission\CaseClosed as CounsellorCaseClosed;



// Manager Portal
use App\Livewire\Manager\Inquiries as ManagerInquiries;
use App\Livewire\Manager\Inquiry\Hot as ManagerHot;
use App\Livewire\Manager\Inquiry\Cold as ManagerCold;
use App\Livewire\Manager\Inquiry\Dead as ManagerDead;
use App\Livewire\Manager\Inquiry\Pending as ManagerPending;
use App\Livewire\Manager\Newinquiry as ManagerNewInquiry;
use App\Livewire\Manager\Reminder as ManagerReminder;
use App\Livewire\Manager\Team\Dashboard as TeamDashboard;
use App\Livewire\Manager\Team\Inquiry as TeamInquiry;
use App\Livewire\Manager\Team\Hot as TeamHot;
use App\Livewire\Manager\Team\Cold as TeamCold;
use App\Livewire\Manager\Team\Dead as TeamDead;
use App\Livewire\Manager\Team\Pending as TeamPending;
use App\Livewire\Manager\ReassignInquiry as ManagerReassignInquiry;
use App\Livewire\Manager\Report\CounsellorReport as ManagerCounsellorReport;

//Manager Admission Portal
use App\Livewire\Manager\Admission\Underassessment as ManagerUnderassessment;
use App\Livewire\Manager\Admission\CaseClosed as ManagerCaseClosed;
use App\Livewire\Manager\Admission\CasReceived as ManagerCasReceived;
use App\Livewire\Manager\Admission\ConditionalOffers as ManagerConditionalOffers;
use App\Livewire\Manager\Admission\UnconditionalOffers as ManagerUnconditionalOffers;
use App\Livewire\Manager\Admission\Enrollment as ManagerEnrollment;
use App\Livewire\Manager\Admission\Processed as ManagerProcessed;
use App\Livewire\Manager\Admission\UnderCas as ManagerUnderCas;
use App\Livewire\Manager\Admission\VisaProcess as ManagerVisaProcess;
use App\Livewire\Manager\Admission\Rejection as ManagerRejection;
use App\Livewire\Manager\Admission\Withdrawn as ManagerWithdrawn;





// Admission Portal
use App\Livewire\Admission\Application\AllApplications as AdmissionAllApplications;
use App\Livewire\Admission\Application\Underassessment as AdmissionUnderAssessment;
use App\Livewire\Admission\Application\CasReceived as AdmissionCasReceived;
use App\Livewire\Admission\Application\ConditionalOffers as AdmissionConditionalOffers;
use App\Livewire\Admission\Application\CaseClosed as AdmissionCaseClosed;
use App\Livewire\Admission\Application\Enrollment as AdmissionEnrollment;
use App\Livewire\Admission\Application\Processed as AdmissionProcessed;
use App\Livewire\Admission\Application\UnderCas as AdmissionUnderCas;
use App\Livewire\Admission\Application\UnconditionalOffers as AdmissionUnconditionalOffers;
use App\Livewire\Admission\Application\VisaProcess as AdmissionVisaProcess;
use App\Livewire\Admission\Assign as AdmissionAssign;
use Illuminate\Support\Facades\Response;
//Admission Team Portal
use App\Livewire\Admission\AdmissionTeam\Application\AllApplications as AdmissionTeamAllApplications;
use App\Livewire\Admission\AdmissionTeam\Dashboard as AdmissionTeamDashboard;
use App\Livewire\Admission\AdmissionTeam\Application\Underassessment as AdmissionTeamUnderAssessment;
use App\Livewire\Admission\AdmissionTeam\Application\CasReceived as AdmissionTeamCasReceived;
use App\Livewire\Admission\AdmissionTeam\Application\ConditionalOffers as AdmissionTeamConditionalOffers;
use App\Livewire\Admission\AdmissionTeam\Application\CaseClosed as AdmissionTeamCaseClosed;
use App\Livewire\Admission\AdmissionTeam\Application\Enrollment as AdmissionTeamEnrollment;
use App\Livewire\Admission\AdmissionTeam\Application\Processed as AdmissionTeamProcessed;
use App\Livewire\Admission\AdmissionTeam\Application\UnderCas as AdmissionTeamUnderCas;
use App\Livewire\Admission\AdmissionTeam\Application\UnconditionalOffers as AdmissionTeamUnconditionalOffers;
use App\Livewire\Admission\AdmissionTeam\Application\VisaProcess as AdmissionTeamVisaProcess;
use App\Livewire\Admission\Reminders as AdmissionReminders;
use App\Livewire\Admission\AdmissionTeam\AllStudents as AdmissionAllStudents;


// Admission Agent Portal
use App\Livewire\AdmissionAgent\Applications\AllApplications as AdmissionAgentAllApplications;
use App\Livewire\AdmissionAgent\Applications\Underassessment as AdmissionAgentUnderAssessment;
use App\Livewire\AdmissionAgent\Applications\CasReceived as AdmissionAgentCasReceived;
use App\Livewire\AdmissionAgent\Applications\ConditionalOffers as AdmissionAgentConditionalOffers;
use App\Livewire\AdmissionAgent\Applications\CaseClosed as AdmissionAgentCaseClosed;
use App\Livewire\AdmissionAgent\Applications\Enrollment as AdmissionAgentEnrollment;
use App\Livewire\AdmissionAgent\Applications\Processed as AdmissionAgentProcessed;
use App\Livewire\AdmissionAgent\Applications\UnconditionalOffers as AdmissionAgentUnconditionalOffers;
use App\Livewire\AdmissionAgent\Applications\VisaProcess as AdmissionAgentVisaProcess;
use App\Livewire\AdmissionAgent\Applications\UnderCas as AdmissionAgentUnderCas;
use App\Livewire\AdmissionAgent\Applications\Rejected as AdmissionAgentRejected;
use App\Livewire\AdmissionAgent\Applications\Withdrawn as AdmissionAgentWithdrawn;

//Admission Agent Forms
use App\Livewire\AdmissionAgent\AdmissionForms\ProcessedForm as AdmissionAgentProcessedForm;
use App\Livewire\AdmissionAgent\AdmissionForms\ConditionalOffersForm as AdmissionAgentConditionalOffersForm;
use App\Livewire\AdmissionAgent\AdmissionForms\UnconditionalOffersForm as AdmissionAgentUnconditionalOffersForm;
use App\Livewire\AdmissionAgent\AdmissionForms\UnderCasForm as AdmissionAgentUnderCasForm;
use App\Livewire\AdmissionAgent\AdmissionForms\VisaProcessForm as AdmissionAgentVisaProcessForm;
use App\Livewire\AdmissionAgent\AdmissionForms\CasReceivedForm as AdmissionAgentCasReceivedForm;
use App\Livewire\AdmissionAgent\AdmissionForms\EnrollmentForm as AdmissionAgentEnrollmentForm;

//External Agents
use App\Livewire\ExternalAgent\Dashboard as ExternalAgentDashboard;
use App\Livewire\ExternalAgent\Applications\AllApplications as ExternalAgentAllApplications;
use App\Livewire\ExternalAgent\AddApplication;
use App\Livewire\ExternalAgent\Applications\CaseClosed as ExternalAgentCaseClosed;
use App\Livewire\ExternalAgent\Applications\CasReceived as ExternalAgentCasReceived;
use App\Livewire\ExternalAgent\Applications\ConditionalOffers as ExternalAgentConditionalOffers;
use App\Livewire\ExternalAgent\Applications\Enrollment as ExternalAgentEnrollment;
use App\Livewire\ExternalAgent\Applications\Processed as ExternalAgentProcessed;
use App\Livewire\ExternalAgent\Applications\UnconditionalOffers as ExternalAgentUnconditionalOffers;
use App\Livewire\ExternalAgent\Applications\Underassessment as ExternalAgentUnderassessment;
use App\Livewire\ExternalAgent\Applications\UnderCas as ExternalAgentUnderCas;
use App\Livewire\ExternalAgent\Applications\VisaProcess as ExternalAgentVisaProcess;


//HR Portal
use App\Livewire\HR\Dashboard as HRDashboard;
use App\Livewire\HR\StaffDetails\AddStaff;
use App\Livewire\HR\StaffDetails\AllStaff;


Route::get('/login', Login::class)->name('login');
Route::get('/', Login::class)->name('login');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::prefix('webhooks')->group(function () {
    Route::get('/meta', [App\Http\Controllers\MetaWebhookController::class, 'verify']);
    Route::post('/meta', [App\Http\Controllers\MetaWebhookController::class, 'handleLead']);
    Route::post('/whatsapp', [App\Http\Controllers\WhatsAppWebhookController::class, 'handle']);
});
Route::middleware(['auth', 'check.status'])->group(function () {
    Route::middleware(['admin', 'viewonly'])->group(function () {

        Route::get('/admin/dashboard', AdminDashboard::class)->name('admin.dashboard');
        Route::get('/admin/inquiries', AdminInquiry::class)->name('admin.inquiries');
        Route::get('admin/main/inquiry/hot', AdminHot::class)->name('admin.hot-inquiries');
        Route::get('admin/main/inquiry/cold', AdminCold::class)->name('admin.cold-inquiries');
        Route::get('admin/main/inquiry/dead', AdminDead::class)->name('admin.dead-inquiries');
        Route::get('admin/main/inquiry/pending', AdminPending::class)->name('admin.pending-inquiries');
        Route::get('/admin/import', Import::class)->name('admin.import');
        Route::get('admin/assign', Assign::class)->name('admin.assign');
        Route::get('admin/reassign', ReassignInquiry::class)->name('admin.reassign');
        Route::get('/admin/users', Users::class)->name('admin.users');
        Route::get('/admin/teams', Teams::class)->name('admin.teams');
        Route::get('/admin/admission-teams', AdmissionTeams::class)->name('admin.admissionteams');
        Route::get('/admin/portallog', Portallog::class)->name('admin.portallog');
        Route::get('/admin/team-reports/{team}', TeamReports::class)->name('admin.teamreports');
        Route::get('/admin/allreports', action: Reports::class)->name('admin.reports');
        Route::get('/admin/counsellor-report/{user}', CounsellorReport::class)->name('admin.counsellorreport');
        Route::get('/admin/dailytargets', DailyTarget::class)->name('admin.dailytarget');
        Route::get('/admin/manageips', AdminManageIPs::class)->name('admin.manageips');
        Route::get('/admin/notifications', Notifications::class)->name('admin.notifications');
        Route::get('/admin/inquiries-detail/{user}', AgentInquiry::class)->name('admin.inquiries-detail');
                Route::get('/admin/registered-details', RegisteredDetail::class)->name('admin.registered-details');
        Route::get('/admin/select-team-inquiries', SelectTeamInquiries::class)->name('admin.select-team-inquiries');
        Route::get('/admin/select-counsellor/{team}', SelectCounsellor::class)->name('admin.select-counsellor');
        Route::get('/admin/roles', \App\Livewire\Admin\Roles::class)->name('admin.roles');

        Route::get('/admin/all-intakes', \App\Livewire\Admin\Intake\AllIntakes::class)->name('admin.all-intakes');
        Route::get('/admin/intake/{intakeId}', \App\Livewire\Admin\Intake\IntakeDetails::class)->name('admin.intake-details');

        
        //Hr Dashboard
        Route::get('/hr/dashboard', HRDashboard::class)->name('hr.dashboard');
        Route::get('/hr/staff/add-staff', AddStaff::class)->name('hr.add-staff');
        Route::get('/hr/staff/all-staff', AllStaff::class)->name('hr.all-staff');

        
        //Admission Inquiry Details
        Route::get('/admin/admission/all-applications', AdminAllApplications::class)->name('admin.all-applications');
        Route::get('/admin/admission/under-assessment', AdminUnderassessment::class)->name('admin.underassessment');
        Route::get('/admin/admission/cas-received', AdminCasReceived::class)->name('admin.cas-received');
        Route::get('/admin/admission/conditional-offers', AdminConditionalOffers::class)->name('admin.conditional-offers');
        Route::get('/admin/admission/case-closed', AdminCaseClosed::class)->name('admin.case-closed');
        Route::get('/admin/admission/processed', AdminProcessed::class)->name('admin.processed');
        Route::get('/admin/admission/under-cas', AdminUnderCas::class)->name('admin.under-cas');
        Route::get('/admin/admission/visa-process', AdminVisaProcess::class)->name('admin.visa-process');
        Route::get('/admin/admission/enrollment', AdminEnrollment::class)->name('admin.enrollment');
        Route::get('/admin/admission/unconditional-offers', AdminUnconditionalOffers::class)->name('admin.unconditional-offers');
        Route::get('/admin/admission/rejection', AdminRejection::class)->name('admin.rejected');
        Route::get('/admin/admission/withdrawn-application', AdminWithdrawn::class)->name('admin.withdrawn');
        Route::get('/admin/admission/allstudents', AllStudents::class)->name('admin.admission.allstudents');

    });
    
    // Agent Dashboard
        Route::middleware(['counsellor'])->group(function () {
            Route::get('/agent/dashboard', AgentDashboard::class)->name('agent.dashboard');
            Route::get('/agent/inquiries', AgentInquiries::class)->name('agent.inquiries');
            Route::get('/agent/newinquiry', AgentNewInquiry::class)->name('agent.newinquiry');
            Route::get('agent/inquiry/hot', AgentHot::class)->name('agent.inquiry.hot');
            Route::get('agent/inquiry/cold', AgentCold::class)->name('agent.inquiry.cold');
            Route::get('agent/inquiry/dead', AgentDead::class)->name('agent.inquiry.dead');
            Route::get('agent/inquiry/pending', AgentPending::class)->name('agent.inquiry.pending');
            Route::get('agent/reminder', AgentReminders::class)->name('agent.inquiry.reminder');
            Route::get('/agent/dailyreport/{date?}', DailyReport::class)->name('agent.dailyreport');
            Route::get('/agent/allreports', AllReports::class)->name('agent.allreports');
            Route::get('/agent/team-reports/', DailyReportReminder::class)->name('agent.daily-report');
            Route::get('/agent/inquiry/registered', AgentRegistered::class)->name('agent.registered');
            Route::get('/agent/admission', AgentAdmissionDashboard::class)->name('agent.admission-dashboard');

            // Agent Routes
            Route::get('/agent/all-intakes', \App\Livewire\Agent\Intake\AllIntakes::class)->name('agent.all-intakes');
            Route::get('/agent/intake-details/{intakeId}', \App\Livewire\Agent\Intake\IntakeDetails::class)->name('agent.intake-details');

            //Agent Admission
            Route::get('/agent/admission/under-assessment', CounsellorUnderassessment::class)->name('agent.admission.under-assessment');
            Route::get('/agent/admission/cas-received', CounsellorCasReceived::class)->name('agent.admission.cas-received');
            Route::get('/agent/admission/conditional-offers', CounsellorConditionalOffers::class)->name('agent.admission.conditional-offers');
            Route::get('/agent/admission/case-closed', CounsellorCaseClosed::class)->name('agent.admission.case-closed');
            Route::get('/agent/admission/enrollment', CounsellorEnrollment::class)->name('agent.admission.enrollment');
            Route::get('/agent/admission/processed', CounsellorProcessed::class)->name('agent.admission.processed');
            Route::get('/agent/admission/under-cas', CounsellorUnderCas::class)->name('agent.admission.under-cas');
            Route::get('/agent/admission/unconditional-offers', CounsellorUnconditionalOffers::class)->name('agent.admission.unconditional-offers');
            Route::get('/agent/admission/visa-process', CounsellorVisaProcess::class)->name('agent.admission.visa-process');

        });
    // Manager Dashboard
    Route::middleware(['manager', 'check.status'])->group(function () {
        Route::get('/manager/dashboard', ManagerDashboard::class)->name('manager.dashboard');
        Route::get('manager/inquiries', ManagerInquiries::class)->name('manager.inquiries');
        Route::get('manager/reassign', ManagerReassignInquiry::class)->name('manager.reassign');
        Route::get('manager/inquiry/hot', ManagerHot::class)->name('manager.inquiry.hot');
        Route::get('manager/inquiry/cold', ManagerCold::class)->name('manager.inquiry.cold');
        Route::get('manager/inquiry/dead', ManagerDead::class)->name('manager.inquiry.dead');
        Route::get('manager/inquiry/pending', ManagerPending::class)->name('manager.inquiry.pending');
        Route::get('manager/newinquiry', ManagerNewInquiry::class)->name('manager.newinquiry');
        Route::get('manager/reminder', ManagerReminder::class)->name('manager.inquiry.reminder');
        Route::get('manager/addreport/{date?}', action: AddReport::class)->name('manager.addreport');
        Route::get('manager/allreports', ManagerAllReports::class)->name('manager.allreports');
        Route::get('manager/daily-reports', DailyReportsReminder::class)->name('manager.daily-reports');
        Route::get('manager/inquiry/registered', ManagerRegistered::class)->name('manager.registered');
        Route::get('manager/admission', ManagerAdmissionDashboard::class)->name('manager.admission-dashboard');

        //Manager Admission
        Route::get('manager/admission/underassessment', ManagerUnderassessment::class)->name('manager.admission.underassessment');
        Route::get('manager/admission/cas-received', ManagerCasReceived::class)->name('manager.admission.casreceived');
        Route::get('manager/admission/case-closed', ManagerCaseClosed::class)->name('manager.admission.caseclosed');
        Route::get('manager/admission/conditional-offers', ManagerConditionalOffers::class)->name('manager.admission.conditionaloffers');
        Route::get('manager/admission/enrollment', ManagerEnrollment::class)->name('manager.admission.enrollment');
        Route::get('manager/admission/processed', ManagerProcessed::class)->name('manager.admission.processed');
        Route::get('manager/admission/rejection', ManagerRejection::class)->name('manager.admission.rejection');
        Route::get('manager/admission/unconditional-offers', ManagerUnconditionalOffers::class)->name('manager.admission.unconditionaloffers');
        Route::get('manager/admission/under-cas', ManagerUnderCas::class)->name('manager.admission.undercas');
        Route::get('manager/admission/visa-process', ManagerVisaProcess::class)->name('manager.admission.visaprocess');
        Route::get('manager/admission/withdrawn', ManagerWithdrawn::class)->name('manager.admission.withdrawn');


        //Team Dashboard
        Route::get('manager/team/dashboard', TeamDashboard::class)->name('manager.team.dashboard');
        Route::get('manager/team/inquiry', TeamInquiry::class)->name('manager.team.inquiry');
        Route::get('manager/team/inquiry/hot', TeamHot::class)->name('manager.team.inquiry.hot');
        Route::get('manager/team/inquiry/cold', TeamCold::class)->name('manager.team.inquiry.cold');
        Route::get('manager/team/inquiry/dead', TeamDead::class)->name('manager.team.inquiry.dead');
        Route::get('manager/team/inquiry/pending', TeamPending::class)->name('manager.team.inquiry.pending');
        Route::get('manager/team/teamreport', TeamReport::class)->name('manager.teamreport');
        Route::get('manager/team/counsellorreport/{user}', ManagerCounsellorReport::class)->name('manager.counsellorreport');
    });

    Route::middleware(['admission', 'check.status'])->group(function () {
    Route::get('/admission/dashboard', AdmissionDashboard::class)->name('admission.dashboard');
    Route::get('/admission/all-applications', AdmissionAllApplications::class)->name('admission.all-applications');
    Route::get('/admission/under-assessment', AdmissionUnderAssessment::class)->name('admission.under-assessment');
    Route::get('/admission/cas-received', AdmissionCasReceived::class)->name('admission.cas-received');
    Route::get('/admission/conditional-offer', AdmissionConditionalOffers::class)->name('admission.conditional-offers');
    Route::get('/admission/case-closed', AdmissionCaseClosed::class)->name('admission.case-closed');
    Route::get('/admission/enrollment', AdmissionEnrollment::class)->name('admission.enrollment');
    Route::get('/admission/processed', AdmissionProcessed::class)->name('admission.processed');
    Route::get('/admission/under-cas', AdmissionUnderCas::class)->name('admission.under-cas');
    Route::get('/admission/rejection', Rejection::class)->name('admission.rejection');

    Route::get('/admission/un-conditional-offers', AdmissionUnconditionalOffers::class)->name('admission.unconditional-offers');
    Route::get('/admission/visa-process', AdmissionVisaProcess::class)->name('admission.visa-process');
    Route::get('/admission/reassign-application', Reassign::class)->name('admission.reassign-application');
    Route::get('/admission/assign-application', AdmissionAssign::class)->name('admission.assign-application');
    Route::get('/admission/applications', function () {
    return view('admission.applications'); // You'll need to create this view
})->name('admission.applications');

// Intake Management Routes
Route::get('/admission/add-intake', \App\Livewire\Admission\Intake\AddIntake::class)->name('admission.add-intake');
Route::get('/admission/all-intakes', \App\Livewire\Admission\Intake\AllIntakes::class)->name('admission.all-intakes');
Route::get('/admission/intake/{intakeId}', \App\Livewire\Admission\Intake\IntakeDetails::class)->name('admission.intake-details');

    
    
    // Admission Team Dashboard
    Route::get('/admission/team/dashboard', AdmissionTeamDashboard::class)->name('admission.team.dashboard');
    Route::get('/admission/team/all-applications', AdmissionTeamAllApplications::class)->name('admission.team.all-applications');
    Route::get('/admission/team/under-assessment', AdmissionTeamUnderAssessment::class)->name('admission.team.under-assessment');
    Route::get('/admission/team/cas-received', AdmissionTeamCasReceived::class)->name('admission.team.cas-received');
    Route::get('/admission/team/conditional-offers', AdmissionTeamConditionalOffers::class)->name('admission.team.conditional-offers'); 
    Route::get('/admission/team/case-closed', AdmissionTeamCaseClosed::class)->name('admission.team.case-closed');
    Route::get('/admission/team/enrollment', AdmissionTeamEnrollment::class)->name('admission.team.enrollment');
    Route::get('/admission/team/processed', AdmissionTeamProcessed::class)->name('admission.team.processed');
    Route::get('/admission/team/under-cas', AdmissionTeamUnderCas::class)->name('admission.team.under-cas');
    Route::get('/admission/team/unconditional-offers', AdmissionTeamUnconditionalOffers::class)->name('admission.team.unconditional-offers');
    Route::get('/admission/team/visa-process', AdmissionTeamVisaProcess::class)->name('admission.team.visa-process');       
    Route::get('/admission/reminders', AdmissionReminders::class)->name('admission.reminders');  
    Route::get('/admission/withdrawn-application', Withdrawn::class)->name('admission.withdrawn');   
    Route::post('/admission/unassign-inquiry', [App\Http\Controllers\AdmissionController::class, 'unassignInquiry'])
    ->name('admission.unassign.inquiry');  

    // Admission Forms
    Route::get('/admission/forms/visa-process-form/{inquiry_id?}', VisaProcessForm::class)->name('admission.forms.visa-process-form');
    Route::get('/admission/forms/conditional-offers-form/{inquiry_id?}', ConditionalOffersForm::class)->name('admission.forms.conditional-offers-form');
    Route::get('/admission/forms/cas-received-form/{inquiry_id?}', CasReceivedForm::class)->name('admission.forms.cas-received-form');
    Route::get('/admission/forms/enrollment-form/{inquiry_id?}', EnrollmentForm::class)->name('admission.forms.enrollment-form');
    Route::get('/admission/forms/processed-form/{inquiry_id?}', ProcessedForm::class)->name('admission.forms.processed-form');
    Route::get('/admission/forms/unconditional-offers-form/{inquiry_id?}', UnconditionalOffersForm::class)->name('admission.forms.unconditional-offers-form');
    Route::get('/admission/forms/under-cas-form/{inquiry_id?}', UnderCasForm::class)->name('admission.forms.under-cas-form');
    Route::get('/admission/team/all-students', AdmissionAllStudents::class)
    ->name('admission.team.all-students');
});

 Route::middleware(['admissionagent', 'check.status'])->group(function () {
    Route::get('/admissionagent/dashboard', AdmissionAgentDashboard::class)->name('admissionagent.dashboard');
    Route::get('/admissionagent/all-applications', AdmissionAgentAllApplications::class)->name('admissionagent.allapplications');
    Route::get('/admissionagent/underassessment', AdmissionAgentUnderAssessment::class)->name('admissionagent.underassessment');
    Route::get('/admissionagent/case-closed', AdmissionAgentCaseClosed::class)->name('admissionagent.caseclosed');
    Route::get('/admissionagent/cas-received', AdmissionAgentCasReceived::class)->name('admissionagent.casreceived');
    Route::get('/admissionagent/conditional-offers', AdmissionAgentConditionalOffers::class)->name('admissionagent.conditionaloffers');
    Route::get('/admissionagent/enrollment', AdmissionAgentEnrollment::class)->name('admissionagent.enrollment');
    Route::get('/admissionagent/processed', AdmissionAgentProcessed::class)->name('admissionagent.processed');    
    Route::get('/admissionagent/unconditional-offers', AdmissionAgentUnconditionalOffers::class)->name('admissionagent.unconditionaloffers');    
    Route::get('/admissionagent/under-cas', AdmissionAgentUnderCas::class)->name('admissionagent.undercas');
    Route::get('/admissionagent/visa-process', AdmissionAgentVisaProcess::class)->name('admissionagent.visaprocess');
    Route::get('/admissionagent/rejected', AdmissionAgentRejected::class)->name('admissionagent.rejected');
    Route::get('/admissionagent/withdrawn-application', AdmissionAgentWithdrawn::class)->name('admissionagent.withdrawn');
    Route::get('/admission-agent/reminders', \App\Livewire\AdmissionAgent\Reminders::class)->name('admission-agent.inquiry.reminder')->middleware('auth');
    
    // Admission Agent Forms
    Route::get('/admissionagent/forms/processed-form/{inquiry_id?}', AdmissionAgentProcessedForm::class)->name('admissionagent.forms.processed-form');
    Route::get('/admissionagent/forms/visa-process-form/{inquiry_id?}', AdmissionAgentVisaProcessForm::class)->name('admissionagent.forms.visa-process-form');
    Route::get('/admissionagent/forms/conditional-offers-form/{inquiry_id?}', AdmissionAgentConditionalOffersForm::class)->name('admissionagent.forms.conditional-offers-form');
    Route::get('/admissionagent/forms/cas-received-form/{inquiry_id?}', AdmissionAgentCasReceivedForm::class)->name('admissionagent.forms.cas-received-form');
    Route::get('/admissionagent/forms/enrollment-form/{inquiry_id?}', AdmissionAgentEnrollmentForm::class)->name('admissionagent.forms.enrollment-form');
    Route::get('/admissionagent/forms/unconditional-offers-form/{inquiry_id?}', AdmissionAgentUnconditionalOffersForm::class)->name('admissionagent.forms.unconditional-offers-form');
    Route::get('/admissionagent/forms/under-cas-form/{inquiry_id?}', AdmissionAgentUnderCasForm::class)->name('admissionagent.forms.under-cas-form');
        
    Route::get('/admissionagent/all-intakes', \App\Livewire\AdmissionAgent\Intake\AllIntakes::class)->name('admissionagent.all-intakes');
Route::get('/admissionagent/intake/{intakeId}', \App\Livewire\AdmissionAgent\Intake\IntakeDetails::class)->name('admissionagent.intake-details');

});

//External Agents
    Route::middleware(['externalagent', 'check.status'])->group(function () {
    Route::get('/externalagent/dashboard', ExternalAgentDashboard::class)->name('externalagent.dashboard');
    Route::get('externalagent/add-application' , AddApplication::class)->name('externalagent.add-application');
    Route::get('externalagent/applications/all-applications' , ExternalAgentAllApplications::class)->name('externalagent.all-applications');
    Route::get('externalagent/applications/cas-received' , ExternalAgentCasReceived::class)->name('externalagent.casreceived');
    Route::get('externalagent/applications/case-closed' , ExternalAgentCaseClosed::class)->name('externalagent.caseclosed');
    Route::get('externalagent/applications/conditional-offers' , ExternalAgentConditionalOffers::class)->name('externalagent.conditionaloffers');
    Route::get('externalagent/applications/enrollment' , ExternalAgentEnrollment::class)->name('externalagent.enrollment');
    Route::get('externalagent/applications/processed' , ExternalAgentProcessed::class)->name('externalagent.processed');
    Route::get('externalagent/applications/unconditional-offers' , ExternalAgentUnconditionalOffers::class)->name('externalagent.unconditionaloffers');
    Route::get('externalagent/applications/under-cas' , ExternalAgentUnderCas::class)->name('externalagent.undercas');
    Route::get('externalagent/applications/underassessment' , ExternalAgentUnderassessment::class)->name('externalagent.underassessment');
    Route::get('externalagent/applications/visa-process' , ExternalAgentVisaProcess::class)->name('externalagent.visaprocess');

    // External Agent Routes
Route::get('/external-agent/intakes', \App\Livewire\ExternalAgent\Intake\AllIntakes::class)->name('external-agent.all-intakes');
Route::get('/external-agent/intake/{intakeId}', \App\Livewire\ExternalAgent\Intake\IntakeDetails::class)->name('external-agent.intake-details');
});
});
$documentRoutes = [
    'matricdmc','intermediatedmc','bshons','babsc','mamsc','referenceletters','cv','passport',
    'experience','englishtest','agentconsent','studentconsent','additionaldocs','refusalletter',
    'extra','extra2','extra3','extra4','extra5','extra6','extra7','extra8','extra9','extra10','extra11',
    // Admission form document routes
    'sop', 'application-submission', 'conditional-document', 'fee-voucher', 'bank-statement', 
'interview-pass', 'tb-test', 'fee-payment', 'extra-undercas', 'cas-document', 'cnic', 
'new-bank-statement', 'visa-history', 'birth-certificate', 'parental-consent-letter', 
'funds-source', 'visa-application', 'appointment-letter', 'decision-letter', 'e-visa', 
'student-id-card'
];

foreach ($documentRoutes as $routeName) {
    Route::get("/{$routeName}/{filename}", function ($filename) use ($routeName) {
        // Check both possible storage paths
        $paths = [
            storage_path("app/private/registered-docs/" . $filename),
            storage_path("app/private/admission-docs/" . $filename)
        ];
        
        foreach ($paths as $path) {
            if (file_exists($path)) {
                return Response::file($path);
            }
        }
        
        abort(404);
    })->where('filename', '.*')->name("{$routeName}.show");
}